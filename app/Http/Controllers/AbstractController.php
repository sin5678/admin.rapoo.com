<?php

namespace App\Http\Controllers;

use View,Route,Auth,Session;
use App\Services\ActionLog\Mark;
use App\Services\MCAManager;

class AbstractController extends Controller
{
    /**
     * 当前方法
     */
    protected $mca;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        $mca = $this->getMCAManager();
        $mca->getCurrentMCAInfo();
        View::share('user', Auth::user());
        View::share('title', $mca->getTitle());
        View::share('controller', $mca->getController());
        View::share('action', $mca->getAction());
    }

    /**
     * 启用操作日志记录
     */
    protected function setActionLog($extDatas = [])
    {
        return app()->make(Mark::BIND_NAME)->setMarkYes()->setExtDatas($extDatas);
    }

    /**
     * 获取路由
     */
    protected function getMCAManager()
    {
        $this->initMCAManager();
        $this->mca = app()->make(MCAManager::MAC_BIND_NAME);
        $routeParams = Route::getRouteParams();
        list($controller, $action) = explode('@', $routeParams['controller']);
        $this->mca->setRouteParams($routeParams);
        $this->mca->setController($controller);
        $this->mca->setAction($action);
        return $this->mca;
    }

    /**
     * 获取路由
     */
    protected function initMCAManager()
    {
        $mca = new MCAManager();
        if(!app()->bound(MCAManager::MAC_BIND_NAME)){   
            app()->singleton(MCAManager::MAC_BIND_NAME, function() use ($mca){
                return $mca;
            });
        }
    }

}