<?php

namespace App\Http\Controllers;

use App\Answer;
use App\QuestionInfo;
use App\Session;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    function index(){
        return back();
    }

    function create(Request $request){
        $request->validate([
            'content' => 'required|max:500',
            'question_id' => 'required',
        ]);
// check auth -> creator_id
        $ans_row = Answer::create([
            'question_id'=>$request['question_id'],
            'content'=>$request['content'],
            'user_id'=>$request['user_id'],
            'is_hidden'=>$request['is_hidden'],// todo: remove
        ]);
        return redirect('question/'.$request['question_id']."#answer_".$ans_row['id']);

    }

    function choseRightAnswer (Request $request){

        $request->validate([
            'question_id' => 'required',
            'answer_id' => 'required',
        ]);
        $ses_id = QuestionInfo::where('quest_id', $request['question_id'])->pluck('session_id')->get(0);//['session_id'];

        $ses_creater = Session::where('id', $ses_id)->pluck('creator_id')->get(0);




        $user_id = 1;  // check auther of session



        if ($user_id == $ses_creater) {
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
    }
}
