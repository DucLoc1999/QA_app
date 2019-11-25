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
        return view('session.create');
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
        $close_time = '';
        if (isset($request['close_time'])) {
            $close_time = str_replace(' ', 'T', $request['close_time']);
        }
        $ses = Session::create([
                'topic'=>$request['topic'],
                'creator_id'=>Auth::id(),
                'password'=>$request['password'],
                'close_time'=>$close_time,
        ]);

        return redirect('session/'.$ses['id']);
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

        return view("question/question_list", compact('session', 'creator_name', 'questions', 'role', 'request'));
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
        echo $request['password'];
        $request->validate([
            'session_id' => 'required|',
            'password' => 'required|max:50',
        ]);

        $ses = Session::where('id', $request['session_id'])->get();
        echo $ses[0]['password'];

        if (count($ses) == 1)
            $session = $ses[0];
        else
            return back();

        if (isset($session['password']) && $session['password'] == $request['password']) {
            if (Auth::check()) {
                User::where('id', Auth::id())
                    ->update([
                        'current_session' => $request['session_id']
                    ]);
                return redirect('session/'.$session['id']);
            } else {
                return redirect('/login');

            }
        } else {
            return back()->withErrors(['Sai mật khẩu']);
        }

        return back();
    }
}
