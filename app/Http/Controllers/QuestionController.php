<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use App\Question;
use App\Session;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    function sessionIsOpen($session_id){
        $close_time = Session::query()->where('id', $session_id)->get()[0]['close_time'];
        $now = str_replace('T', ' ', Carbon::now());
        return $now < $close_time;
    }

    public function index(Request $request)
    {
        return back();
    }

    public function create(Request $request)
    {
        $request->validate([
            'session_id' => 'required|max:10'
        ]);
        $session_id = $request['session_id'];
        return view('question.create' , compact('session_id'));
    }

    public function store(Request $request)
    {
        if (!Auth::check())
            return redirect('login');
        $request->validate([
            'content' => 'required|max:100',
            'session_id' => 'required|max:500',
        ]);

        if (!$this->sessionIsOpen($request['session_id']))
            return back();


        $quest = Question::create([
            'content'=>$request['content'],
            'asker_id'=> Auth::id(),
            'session_id'=>$request['session_id'],
        ]);
        return redirect('/session/'.$request['session_id'].'#question_'.$quest['id']);
    }

    public function show(Question $question, Request $request)
    {
        $query = Answer::where('question_id', $question['id']);
        if(isset($request['sort'])){
            if ($request['sort'] == "newest") {
                $answers = $query->orderBy('created_at', 'desc')->get();
            }elseif ($request['sort'] == "oldest") {
                $answers = $query->orderBy('created_at', 'asc')->get();
            }
        }

        if(!isset($answers))  //default
            $answers = $query->orderBy('right_answer', 'desc')->get();


        if (!isset($answers)){
            $answers = $query->get();
        }

        $users_id = $query->pluck('user_id')->toArray();
        $users_id[] = $question['asker_id'];

        $comments = [];
        foreach ($answers as $ans){
            $query = Comment::where('answer_id', $ans['id']);
            $users_id = array_merge($users_id, $query->pluck('user_id')->toArray());
            $comments[$ans['id']] = $query->get();
        }

        $users_id = array_unique($users_id);
        sort($users_id);
        $users_names = array_combine($users_id, User::wherein('id', $users_id)->pluck('name')->toarray());

        $role = null;

        if (Auth::check()){
            $creator = Session::query()->where('id', $question['session_id'])->get()[0]['creator_id'];
            if ($creator == Auth::id())
                $role = "session_creator";
            else
                $role = "viewer";
        }

        $is_open = false;
        if ($this->sessionIsOpen($question['session_id']))
            $is_open = true;

        return view('question/answer_comment', compact('request', 'question','answers', 'comments', 'users_names', 'role', 'is_open'));
    }

    public function edit(Question $question)
    {
        //
    }

    public function update(Request $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        //
    }
}
