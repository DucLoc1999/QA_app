<?php

namespace App\Http\Controllers;

use App\Session_info;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function secsion_list(Request $request){
        if(isset($request['search']) && $request['search'] != ""){
            $sessions = Session_info::where('topic','like','%'.str_replace(' ','%',$request['search']).'%')->get();
        }
        elseif(isset($request['soft'])) {
            if ($request['soft'] == "concerned") {
                $sessions = Session_info::orderBy('quest_num', 'desc')->get();
            } elseif ($request['soft'] == "Newest") {
                $sessions = Session_info::orderBy('lsst_quest', 'desc')->get();
            }
        }else{
            $sessions = Session_info::all();
        }
        return view("listing", compact('sessions'));
    }
}
