<?php

namespace App\Http\Controllers;

use App\Question;
use App\Question_info;
use App\Session;
use App\session_img;
use App\Session_info;
use App\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request['search']) || isset($request['sort'])){
            if($request['search'] != ""){
                $sessions = Session_info::where('topic','like','%'.str_replace(' ','%',$request['search']).'%')->get();
            }
            elseif ($request['sort'] == "concerned") {
                $sessions = Session_info::orderBy('quest_num', 'desc')->get();
            }elseif ($request['sort'] == "newest") {
                $sessions = Session_info::orderBy('last_quest', 'desc')->get();
            }
            if (isset($sessions))
                return view("session/index", compact('sessions'));
        }

        $sessions = Session_info::all();
        return view("session/index", compact('sessions'));
    }

    public function create()
    {
        return view('session.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required|max:100',
            'password' => 'max:50',
        ]);
// check auth -> creator_id
        Session::create([
            'topic'=>$request['topic'],
                'creator_id'=>$request['creator_id'],
                'password'=>$request['password'],
                'close_time'=>$request['close_time'],
                'img_id'=>strval(rand(1,13)),
        ]);
        //$req = Request::create("","GET",[array("_token" => $request->_token, 'sort'=>'newest')]);
        return redirect('session?sort=newest');
            //->with('success','Item created successfully');
    }

    public function show(Session $session, Request $request)
    {

        $creator_name = User::where('id',$session['creator_id'])->value('name');
        $query = Question_info::where('session_id', $session['id']);
        if(isset($request['search']) || isset($request['sort'])){
            if($request['search'] != ""){
                $questions = $query->where('content','like','%'.str_replace(' ','%',$request['search']).'%')->get();
            }
            elseif ($request['sort'] == "concerned") {
                $questions = $query->orderBy('total_comment', 'desc')->get();
            }elseif ($request['sort'] == "newest") {
                $questions = $query->orderBy('last_action', 'desc')->get();
            }
        }

        if(!isset($questions)){
            $questions = $query->get();
        }

        return view("session/session_page", compact('session', 'creator_name', 'questions'));
    }

    public function edit(Session $session)
    {
        //
    }

    public function update(Request $request, Session $session)
    {
        //
    }

    public function destroy(Session $session)
    {
        //
    }

    public function checkPassword(Request $request){
        $request->validate([
            'session_id' => 'required|',
            'password' => 'required|max:50',
        ]);
        $row = Session::select('password')->where('id', $request['session_id'])->get();
        if (isset($request['question_id'])){
            Question::where()->get();
//todo: check question_id vs ssid
        }
        if (count($row)){
            $password = $row[0]['password'];
            if ($request['password'] == $password)
                return view();
        }

        return back();
    }
}
