<?php

namespace App\Http\Middleware;

use Closure,Entrust,View,Route,Auth;
use Illuminate\Contracts\Auth\Guard;

class PermissionLimit
{
    /**
     * Create a new filter instance.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * 权限执行中间件
     *
     */
	public function handle($request, Closure $next)
    {
       
       self::shareParams();
        
       return $next($request);
       
    }

    /**
     * 分配视图公共参数
     * 
     */
    public function shareParams()
    {
        $data = array(
            'username'=> Auth::user()['original']['account']?Auth::user()['original']['account']:'' ,
            'uploadSize'=>ini_get('upload_max_filesize'),
        );
         return view::share($data);
    }
}//
