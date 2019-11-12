<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function index(){
        return back();
    }

    function create(Request $request){
        $request->validate([
            'content' => 'required|max:500',
            'answer_id' => 'required|',
        ]);
// check auth -> creator_id
        Comment::create([
            'answer_id'=>$request['answer_id'],
            'content'=>$request['content'],
            'user_id'=>$request['user_id'],
            'is_hidden'=>$request['is_hidden'],// todo: remove
        ]);
        return redirect('question/'.$request['question_id']."#answer_".$request['answer_id']);

    }

}
