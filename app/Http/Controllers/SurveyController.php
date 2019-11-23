<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Session;
use App\Survey;
use App\SurveyOption;
use App\SurveyStatistic;
use App\User;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'session_id' => 'required|max:10'
        ]);
        $session_id = $request['session_id'];
        return view("/survey/create", compact('session_id'));
    }

    function insertServey($session_id, $content, $options){
        $survey = Survey::create([
            'content' => $content,
            'asker_id' => Auth::id(),
            'session_id' => 2,
        ]);

        foreach ($options as $num => $content){
            SurveyOption::create([
                'survey_id' => $survey['id'],
                'option_num' => $num,
                'content' => $content,
            ]);
        }

        return redirect('session/'.$session_id.'/survey#survey_'.$survey['id']);
    }

    function vote($session_id, $survey_vote){
        foreach ($survey_vote as $survey_id => $option) {
            $query = Vote::where('survey_id', $survey_id)
                ->where('user_id', Auth::id());

            if (count($query->get()) == 1) {
                $query->update(['vote' => $option]);
            } else {
                Vote::create([
                    "survey_id" => $survey_id,
                    "vote" => $option,
                    "user_id" => Auth::id()
                ]);
            }
        }
        return back();
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        if(isset($request['action']) && $request['action'] == 'vote'){
            $survey_vote = [];
            foreach ($request->except('_token') as $key => $value){
                if (preg_match('/^survey_\d+_vote/', $key) == 1){
                    $array = preg_split('/_/', $key);
                    $survey_vote[$array[1]] = $value;
                }
            }
            return $this->vote($request['session_id'], $survey_vote);
        } elseif (isset($request['action']) && $request['action'] == 'create') {
            $request->validate([
                'session_id' => 'required|max:10',
                'content' => 'required|max:255',
                'option_1' => 'required|max:255',
                'option_2' => 'required|max:255'
            ]);
            $options = [];
            foreach ($request->except('_token') as $key => $value){
                if (preg_match('/^option_\d+/', $key) == 1){
                    $array = preg_split('/_/', $key);
                    $options[$array[1]] = $value;
                }
            }

            return $this->insertServey($request['session_id'], $request['content'], $options);
        }
        return back();
    }


    public function showSurvey(Session $session, Request $request)
    {
        $creator_name = User::where('id',$session['creator_id'])->value('name');

        $survey_query = Survey::where('session_id', $session['id']);

        // lọc
        if(isset($request['search']) && $request['search'] != "") {
            $survey_query = $survey_query->where('content', 'like', '%' . str_replace(' ', '%', $request['search']) . '%');
        }

        // lấy vote của user trong các survey này
        $survey_id = $survey_query->pluck('id')->toArray();

        if (Auth::check()) {
            $query = Vote::select('survey_id', 'vote')->where('user_id', Auth::id())->whereIn('survey_id', $survey_id);
            $voted_survey = $query->pluck('survey_id')->toArray();
            $votes = $query->pluck('vote')->toArray();
            $user_votes = array_combine($voted_survey, $votes);
            unset($query);
        } else {
            $voted_survey = [];
            $user_votes = [];
        }
        unset($survey_id);
        // end lấy vote
        // lọc
        if(isset($request['status'])){
            if ($request['status'] == "checked") {
                $survey_query = $survey_query->whereIn('id', $voted_survey);
            }elseif ($request['status'] == "unchecked") {
                $survey_query = $survey_query->whereNotIn('id', $voted_survey);
            }
        }

        // lọc
        if (isset($request['sort'])) {
            if ($request['sort'] == "newest") {
                $survey_query = $survey_query->orderBy('created_at', 'desc');
            } else {
                $survey_query = $survey_query->orderBy('created_at', 'asc');
            }
        }

        $surveys = $survey_query->get();
        $sur_options = [];
        // lấy option và gán checked cho n cái auth đã check
        foreach ($surveys as $sur) {
            if (in_array($sur['id'], $voted_survey)) {
                $options = SurveyOption::where('survey_id', $sur['id'])->get();
                foreach ($options as $opt) {
                    if ($opt['option_num'] == $user_votes[$sur['id']])
                        $opt['checked'] = true;
                }
                $sur_options[$sur['id']] = $options;
            } else {
                $sur_options[$sur['id']] = SurveyOption::where('survey_id', $sur['id'])->get();
            }
        }

        $role = null;
        if (Auth::check()){
            $role = User::where('id', Auth::id())->get()[0]['role'];
        }

        return view("survey\survey_list", compact('session', 'creator_name','surveys', 'sur_options', 'role', 'request'));
    }

    public function showStatistic(Session $session, Request $request)
    {
        $creator_name = User::where('id',$session['creator_id'])->value('name');

        $survey_query = Survey::where('session_id', $session['id']);

        // lọc
        if(isset($request['search']) && $request['search'] != "") {
            $survey_query = $survey_query->where('content', 'like', '%' . str_replace(' ', '%', $request['search']) . '%');
        }

        // lọc
        if (isset($request['sort'])) {
            if ($request['sort'] == "newest") {
                $survey_query = $survey_query->orderBy('created_at', 'desc');
            } else {
                $survey_query = $survey_query->orderBy('created_at', 'asc');
            }
        }

        $surveys = $survey_query->get();
        $statistic = [];
        // lấy option và gán checked cho n cái auth đã check
        foreach ($surveys as $sur) {
            $sur['total_vote'] = SurveyStatistic::where('survey_id', $sur['id'])
                ->sum('total_vote');
            $sur_options[$sur['id']] = SurveyStatistic::select('survey_id', 'option_num','content', 'total_vote')
                ->where('survey_id', $sur['id'])->get();
        }

        $role = null;
        if (Auth::check()){
            $role = User::where('id', Auth::id())->get()[0]['role'];
        }

        return view("survey\survey_statistic", compact('session', 'creator_name','surveys', 'sur_options', 'role', 'request'));
    }

    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
