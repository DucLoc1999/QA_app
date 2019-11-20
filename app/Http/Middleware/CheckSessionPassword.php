<?php

namespace App\Http\Middleware;

use App\Session;
use Closure;
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

    function session($path_arr, $request, Closure $next){

        if (isset($path_arr[2])) {
            $ses = Session::select('creator_id', 'password')->where('id', $path_arr[2])->get()[0];
            if (/*Auth::id*/ 2 != $ses['creator_id'] /*Auth::[session_list]*/){
                $session_id = $path_arr[2];
                return redirect('session/'.$session_id.'/0/check_password');
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
        }

        return $next($request);
    }
}
