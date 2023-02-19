<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Illuminate\Http\Request;
use App\Models\User;

class AuthUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        LOG::notice("檢查權限");
        $user_data=session()->get('user_data');
        if(!empty($user_data)){
            LOG::notice($user_data);

            $get_user=User::findOrFail($user_data->id);
    
            if($get_user->type =="a"){
                LOG::notice("有權限");
                return $next($request);
            }
        }
        
        LOG::notice("沒有權限");
        return redirect('homepage/index');
    }
}
