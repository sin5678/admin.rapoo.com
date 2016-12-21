<?php
namespace App\Services\Permission;

use View,Route,Entrust,DB;
use App\Services\MCAManager;

class Permission
{   
    /**
     * 验证角色，权限， 分配公共变量
     *
     * @param  
     * @return bool
     */
    public function currentActive()
    {
        $MCA = app()->make(MCAManager::MAC_BIND_NAME);
        $route = $MCA->getRouteParams();
        if( isset( $route['role'] ) && !empty( $route['role'] )){
            if( !Entrust::hasRole( [ $route['role'] ] ) ){ die('!'); }
        }
        
        if( isset( $route['permission'] ) && !empty( $route['permission'] )){
            if( !Entrust::can( [ $route['permission'] ] ) ){ die('!'); }
        }
        
        $data['controller']  = explode('@', $route['controller'])[0];
        $data['action']  = explode('@', $route['controller'])[1];
        view::share($data);
    }
}