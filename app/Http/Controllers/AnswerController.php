<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
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
        if ($request['action'] == 'create') {
            return $this->create($request);
        } elseif ($request['action'] == 'chose_right'){
            return $this->choseRightAnswer($request);
        }
        return back();
    }
}
