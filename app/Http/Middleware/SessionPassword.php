<?php

namespace App\Http\Middleware;

use App\Session;
use Closure;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class sessionPassword
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
            echo $ses;
            if (/*Auth::id*/ 1 != $ses['creator_id'] /*Auth::[session_list]*/){
                echo "nhập Mật khẩu phiên";
                $session_id = $path_arr[2];
                echo $session_id;
                return redirect('session/'.$path_arr[2].'/0/check password');
            }
        }
        return $next($request);

    }

    function question($path_arr, $request, Closure $next){
        return redirect('session/'.$path_arr[2].'/'.$path_arr[3].'/check password');

    }

    function answer($path_arr, $request, Closure $next){

    }

    function comment($path_arr, $request, Closure $next){

    }

    public function handle($request, Closure $next)
    {
        $path = $request->getPathInfo();
        $arr = explode("/", $path);
        if ($arr[1] == "session"){

            return $this->session($arr, $request, $next);
        } elseif ($arr[1] == "question"){
            return $this->question($request, $next);
        } elseif ($arr[1] == "answer"){
            return $this->answer($request, $next);
        } elseif ($arr[1] == "comment"){
            return $this->comment($request, $next);
        }

        return $next($request);
    }
}
