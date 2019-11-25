<?php

namespace App\Http\Controllers;

use App\Session;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $sessions = Session::where('creator_id',$request->id)->get();
        $user = User::where('id',Auth::id())->get();

        return view('user.index',compact('sessions','user'));
    }
}
