<?php

namespace App\Http\Middleware;

use Closure;
use App\user;
use Auth;

class Roles
{

    /**Requeriments: -->authorization */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$roles)
    {
        //get User
        $userId = Auth::user()->id;
        //split
        $rolesParse = explode("|",$roles);
        //lamda
        $permision = user::with("roles")->where("id","=",$userId)
                                        ->whereHas("roles",function($q) use($rolesParse){
                                            $q->whereIn("name",$rolesParse);
                                        })->count();

        if($permision>0){
            return $next($request);
        }

        return redirect()->guest('error/unAuthorize');
    }
}
