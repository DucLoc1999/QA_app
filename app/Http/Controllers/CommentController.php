<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
            return redirect('login');

        $request->validate([
            'content' => 'required|max:500|min:1',
            'answer_id' => 'required|',
            'session_id' => 'required'
        ]);

        if (!$this->sessionIsOpen($request['session_id']))
            return back();

        Comment::create([
            'answer_id'=> $request['answer_id'],
            'content'=> $request['content'],
            'user_id'=> Auth::id(),
        ]);
        return back();

    }

}
