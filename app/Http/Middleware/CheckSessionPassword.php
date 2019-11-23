<?php

namespace App\Http\Middleware;

use App\Session;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class checkSessionPassword
{
    /**
     * Handle an incoming request.
     *
     * @param $path_arr
     * @param \Closure $next
     * @return mixed
     */
    function checkAuthCurrentSession($auth_id, $session_id){
        $current_session = User::select('current_session')->where('id', strval($auth_id))->get()[0];

        if ($current_session['current_session'] == $session_id) {
            return true;
        }
        else
            return false;
    }

    function session($path_arr, $request, Closure $next){
        if (isset($path_arr[2])) {
            $ses = Session::select('creator_id', 'password')->where('id', $path_arr[2])->get()[0];
            if (isset($ses['password']) && $ses['password'] != '') {
                if (Auth::check()){
                    if (strval(Auth::id()) == $ses['creator_id'] || $this->checkAuthCurrentSession(Auth::id(), $path_arr[2])) {
                        return $next($request);
                    } else {
                        $session_id = $path_arr[2];
                        return redirect('session/' . $session_id . '/0/check_password');
                    }
                } else {
                    return redirect('/login'); // todo: charge sesson -> login
                }
            }
        }
        return $next($request);

    }

    function question($path_arr, $request, Closure $next){
        return $next($request);
        return redirect('session/'.$path_arr[2].'/'.$path_arr[3].'/check password');

    }

    function answer($path_arr, $request, Closure $next){
        return $next($request);

    }

    function comment($path_arr, $request, Closure $next){
        return $next($request);

    }

    public function handle($request, Closure $next)
    {
        $path = $request->getPathInfo();
        $arr = explode("/", $path);
        if ($arr[1] == "session"){
            return $this->session($arr, $request, $next);
        } elseif ($arr[1] == "question"){
            return $this->question($arr, $request, $next);
        } elseif ($arr[1] == "answer"){
            return $this->answer($arr, $request, $next);
        } elseif ($arr[1] == "comment"){
            return $this->comment($arr, $request, $next);
        } else
            return $next($request);
    }
}
