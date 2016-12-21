<?php 

namespace App\Http\Middleware;

use Closure,Route;
use App\Services\ActionLog\Mark;
use App\Services\MCAManager;

/**
 * 用户操作日志
 */
class ActionLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $mark = $this->initLogMark();
        $response = $next($request);
        //$this->log();
        return $response;
    }

    /**
     * 写入日志
     */
    private function log()
    {
        $MCA = app()->make(MCAManager::MAC_BIND_NAME);
        $action = ucwords($MCA->getAction());
        $controller  = ucwords($MCA->getController());
        $controller = substr(substr($controller, strlen('\\App\\Http\Controllers\\')-1),0,-10);
        $action = ucfirst($action);
        $logNamespace = '\\App\\Services\\ActionLog\\';
        $manager = $logNamespace.$controller.'\\'.$action;
        if(!class_exists($manager)) return false;
        $managerObj = new $manager();
        $instanceof = $managerObj instanceof \App\Services\AbstractActionLog;
        if(!$instanceof) return false;
        $managerObj->handler();
    }

    /**
     * 获取实例
     */
    private function initLogMark()
    {
        $mark = new Mark();
        if(!app()->bound(Mark::BIND_NAME)){   
            app()->singleton(Mark::BIND_NAME, function() use ($mark){
                return $mark;
            });
        }
    }

}
