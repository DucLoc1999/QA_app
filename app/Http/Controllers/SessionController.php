<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionInfo;
use App\Session;
use App\SessionInfo;
use App\Survey;
use App\SurveyOption;
use App\User;
use App\Vote;
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
        $role = null;
        if (Auth::check()){
            $role = User::query()->where('id', Auth::id())->get()[0]['role'];
        }
        return view("session/session_list", compact('sessions', 'request', 'role'));
    }

    public function create()
    {
        return view('session.create', compact('request'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()){
            return redirect('login');  //todo: charge
        } else {
            $user = User::query()->where('id', Auth::id())->get();
            if (count($user) == 1){
                $user = $user[0];
                if ($user['role'] != 'teacher')
                    return redirect('/session');
            }
        }
        $request->validate([
            'topic' => 'required|max:100',
            'password' => 'max:50',
        ]);

        Session::create([
                'topic'=>$request['topic'],
                'creator_id'=>Auth::id(),
                'password'=>$request['password'],
                'close_time'=>$request['close_time'],
        ]);

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

        $role = null;
        if (Auth::check()){
            $role = User::where('id', Auth::id())->get()[0]['role'];
        }

        return view("session/session_page", compact('session', 'creator_name', 'questions', 'role', 'request'));
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
