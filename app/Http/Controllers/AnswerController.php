<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    function sessionIsOpen($session_id){
        $close_time = Session::query()->where('id', $session_id)->get()[0]['close_time'];
        $now = str_replace('T', ' ', Carbon::now());
        return $now < $close_time;
    }
    function index(){
        return back();
    }

    function create(Request $request){
        if (!Auth::check())
            return redirect('/login');

        $request->validate([
            'content' => 'required|max:500',
            'question_id' => 'required',
        ]);


        $ans = Answer::create([
            'question_id'=> $request['question_id'],
            'content'=> $request['content'],
            'user_id'=> Auth::id(),
        ]);
        return redirect('question/'.$request['question_id']."#answer_".$ans['id']);

    }

    function choseRightAnswer (Request $request){
        if (!Auth::check())
            return redirect('login');

        $request->validate([
            'question_id' => 'required',
            'answer_id' => 'required',
        ]);
        $ses_id = Question::where('id', $request['question_id'])->pluck('session_id')->get(0);

        $ses_creater = Session::where('id', $ses_id)->pluck('creator_id')->get(0);


        if (Auth::id() == $ses_creater) {
            $ans = Answer::find($request['answer_id']);
            $ans['right_answer'] = 1 - $ans['right_answer'];
            $ans->save();
        }
        return redirect('question/'.$request['question_id']."#answer_".$request['answer_id']);
    }

    function postCheck(Request $request){
        $request->validate([
            'question_id' => 'required',
        ]);



        $session_id = Question::query()->where('id', $request['question_id'])->get()[0]['session_id'];
        if (!$this->sessionIsOpen($session_id))
            return back();

        if ($request['action'] == 'create') {
            return $this->create($request);
        } elseif ($request['action'] == 'chose_right'){
            return $this->choseRightAnswer($request);
        }
        return back();
    }
}
