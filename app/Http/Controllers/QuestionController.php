<?php

namespace App\Http\Controllers;

use App\Question_info;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function secsion_list(Request $request){
        if(isset($request['search']) && $request['search'] != ""){
            $quests = Question_info::where('content','like','%'.str_replace(' ','%',$request['search']).'%')->get();
        }
        elseif(isset($request['soft'])) {
            if ($request['soft'] == "concerned") {
                $quests = Session_info::orderBy('total_comment', 'desc')->get();
            } elseif ($request['soft'] == "Newest") {
                $quests = Session_info::orderBy('last_action', 'desc')->get();
            }
        }else{
            $quests = Session_info::all();

        }
        return view("session", compact('quests'));
    }
}
