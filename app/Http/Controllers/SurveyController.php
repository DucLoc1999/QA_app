<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Session;
use App\Survey;
use App\SurveyOption;
use App\SurveyStatistic;
use App\Vote;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $survey_query = Survey::query();

        if(isset($request['search']) && $request['search'] != "") {
            $survey_query = $survey_query->where('content', 'like', '%' . str_replace(' ', '%', $request['search']) . '%');
        } else {
            if (isset($request['sort'])) {
                if ($request['sort'] == "newest") {
                    $survey_query = $survey_query->orderBy('created_at', 'desc');
                } else {
                    $survey_query = $survey_query->orderBy('created_at', 'asc');

                }
            }
        }

        $survey_id = $survey_query->pluck('id')->toArray();

        $surveys = $survey_query->get();

        $sur_options = [];
        $sur_open = [];
        $user_votes = [];
        // check user id
        $user_id = 3;

        foreach ($surveys as $sur){
            $sur_options[$sur['id']] = SurveyOption::where('survey_id', $sur['id'])->get();
            $close_time = Session::where('id', $sur['id'])->pluck('close_time')->get(0)['close_time'];
            $sur_open[$sur['id']] = (is_null($close_time) || time() < strtotime($close_time)) ? true : false;
            $user_votes[$sur['id']] = Vote::where('user_id', $user_id)->where('survey_id', $sur['id'])->get()[0];
        }
        //return $sur_options;
        //return $user_votes;
        return view("survey\survey_list", compact('surveys', 'sur_options', 'user_votes', 'sur_open'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request['action']) && $request['action'] == 'vote'){
            $request->validate([
                'survey_id' => 'required',
                'vote' => 'required',
            ]);
            // check suther id
            $vote = Vote::where('survey_id', $request['survey_id'])
                ->where('user_id', 3 /*auther*/);

            if (isset($vote)){
                $vote->update(['vote' => $request['vote']]);
            } else {
                Vote::creat([
                    "survey_id" => $request['survey_id'],
                    "vote" => $request['vote'],
                    "user_id" => $request['user_id']
                ]);
            }
            return redirect('/survey#survey_'.$request['survey_id']);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
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
