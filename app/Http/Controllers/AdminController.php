<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getQuestion(Request $request){

        $user = User::where('id', '=', $request['id'])->get();
        return view('master', compact('user'));
    }

    public function addQuestion(Request $request){
        if($request['id'].isn)
    }


}
