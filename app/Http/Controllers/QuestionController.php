<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use App\Question;
use App\QuestionInfo;
use App\Survey;
use App\SurveyStatistic;
use App\User;
use Illuminate\Http\Request;
use function Sodium\add;

class QuestionController extends Controller
{

    public function index(Request $request)
    {
        $query = QuestionInfo::query();

        if(isset($request['search']) && $request['search'] != "") {
            $query = $query->where('content', 'like', '%' . str_replace(' ', '%', $request['search']) . '%');
        } else {
            if (isset($request['sort'])) {
                if ($request['sort'] == "newest") {
                    $query = $query->orderBy('created_at', 'desc');
                } else {
                    $query = $query->orderBy('created_at', 'asc');

                }
            }
        }

        $questions = $query->get();
        return view("question\question_list", compact('questions'));
    }

    public function create()
    {
        return view('question.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:100',
            'session_id' => 'required|max:500',
        ]);
// check auth -> creator_id
        $quest = Question::create([
            'content'=>$request['content'],
            'asker_id'=>$request['asker_id'],
            'session_id'=>$request['session_id'],
        ]);
        return redirect('session/'.$request['session_id'].'?sort='.$quest['id']);
    }

    public function show(Question $question, Request $request)
    {
        $query = Answer::where('question_id', $question['id']);
        if(isset($request['sort'])){
            if ($request['sort'] == "newest") {
                $answers = $query->orderBy('created_at', 'desc')->get();
            }elseif ($request['sort'] == "oldest") {
                $answers = $query->orderBy('created_at', 'asc')->get();
            }elseif ($request['sort'] == "right") {
                $answers = $query->orderBy('right_answer', 'desc')->get();
            }
        }

        if (!isset($answers)){
            $answers = $query->get();
        }

        $users_id = $query->pluck('user_id')->toArray();

        $comments = [];
        foreach ($answers as $ans){
            $query = Comment::where('answer_id', $ans['id']);
            $users_id = array_merge($users_id, $query->pluck('user_id')->toArray());
            $comments[$ans['id']] = $query->get();
        }
        $users_id = array_unique($users_id);
        sort($users_id);
        $users_name = array_combine($users_id, User::wherein('id', $users_id)->pluck('name')->toarray());
        return view('question/answer_comment', compact('question','answers', 'comments', 'users_name'));
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
