<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    function index(){
        return back();
    }

    function create(Request $request){
        return $request;
        if (!Auth::check())
            return redirect('login');

        $request->validate([
            'content' => 'required|max:500',
            'answer_id' => 'required|',
        ]);

        Comment::create([
            'answer_id'=> $request['answer_id'],
            'content'=> $request['content'],
            'user_id'=> Auth::id(),
        ]);
        return redirect('question/'.$request['question_id']."#answer_".$request['answer_id']);

    }

}
