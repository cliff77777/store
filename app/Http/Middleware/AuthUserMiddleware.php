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
        $user_id=session()->get('user_id');
        if(!empty($user_id)){
            LOG::notice($user_id);

            $get_user_role_status=User::findOrFail($user_id);
    
            if($get_user_role_status->type =="A"){
                LOG::notice("有權限");
                return $next($request);
            }
        }
        
        LOG::notice("沒有權限");
        return redirect('homepage/index');
    }
}
