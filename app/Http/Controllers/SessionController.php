<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionInfo;
use App\Session;
use App\SessionInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class SessionController extends Controller
{

    public function index(Request $request){
        $query = SessionInfo::query();
        if(isset($request['status'])){
            if ($request['status'] == "close") {
                $query = $query->where('close_time', '>','CURRENT_TIMESTAMP');
            }elseif ($request['status'] == "open") {
                $query = $query->where('close_time', '<=','CURRENT_TIMESTAMP')
                    ->orWhereNull('close_time');
                ;
            }
        }
        if(isset($request['search']) && $request['search'] != "") {
            $query = $query->where('topic', 'like', '%' . str_replace(' ', '%', $request['search']) . '%');
        }
        if (isset($request['sort'])) {
            if ($request['sort'] == "concerned") {
                $query = $query->orderBy('quest_num', 'desc');
            }elseif ($request['sort'] == "newest") {
                $query = $query->orderBy('created_at', 'desc');
            } else {
                $query = $query->orderBy('created_at', 'asc');

            }
        }

        $sessions = $query->get();
        return view("session/index", compact('sessions', 'request'));
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
        if (Auth::check()){
            Session::create([
                'topic'=>$request['topic'],
                'creator_id'=>Auth::id(),
                'password'=>$request['password'],
                'close_time'=>$request['close_time'],
                'img_id'=>strval(rand(1,13)),
            ]);
        }
        //$req = Request::create("","GET",[array("_token" => $request->_token, 'sort'=>'newest')]);
        return redirect('session?sort=newest');
    }

    public function show(Session $session, Request $request)
    {
        $creator_name = User::where('id',$session['creator_id'])->value('name');
        $query = QuestionInfo::where('session_id', $session['id']);

        if(isset($request['search']) && $request['search'] != "") {
            $query = $query->where('content', 'like', '%' . str_replace(' ', '%', $request['search']) . '%');
        }

        if(isset($request['sort'])){
            if ($request['sort'] == "concerned") {
                $query = $query->orderBy('total_comment', 'desc');
            }elseif ($request['sort'] == "newest") {
                $query = $query->orderBy('created_at', 'desc');
            }else {
                $query = $query->orderBy('created_at', 'asc');
            }
        }

        $questions = $query->get();


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

        $ses = Session::where('id', $request['session_id'])->get();
        if (count($ses) == 1)
            $session = $ses[0];
        else
            return back();

        /*if (isset($request['question_id'])){
            Question::where()->get();
//todo: check question_id vs ssid
        }*/

        if (isset($session['password']) && $session['password'] != '') {
            if (Auth::check()) {
                if (Auth::id() == $session['creator_id'] || $request['password'] == $session['password']){
                    User::where('id', Auth::id())
                        ->update([
                            'current_session' => $request['session_id']
                        ]);
                    return redirect('session/'.$session['id']);
                } else {
                    return back();
                }
            } else {
                redirect('\login'); // todo: charge sesson -> login
            }
        } else {
            return redirect('session/'.$session['id']);
        }

        return back();
    }
}
