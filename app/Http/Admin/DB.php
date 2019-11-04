<?php


namespace App\Http\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Question;

class DB extends Controller
{

    /*public function pushdata()
    {
        return view('page\details');
    }*/


    public function getdata(Request $request)
    {
            $user = Question::where(['id' => $request->id,]);

            return view('master', compact('user'));
    }
}
