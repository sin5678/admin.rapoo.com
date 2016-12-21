<?php 
namespace App\Services;

use App\Services\Permission\Permission;
use Config;

/**
 * 主要用来储存当前请求的模块、类、函数
 */
class MCAManager {

    /**
     * 当前类绑定到容器中的标识
     *
     * @var string
     */
    CONST MAC_BIND_NAME = 'mac';

    /**
     * 当前请求的类
     * 
     * @var string
     */
    private $controller;

    /**
     * 当前请求的函数
     * 
     * @var string
     */
    private $action;

    /**
     * 当前请求的函数
     * 
     * @var string
     */
    private $routeParmas;

    /**
     * 当前请求所对应的详细的功能信息
     * 
     * @var array
     */
    private $currentMCA;

    /**
     * 当前登录用户的所有权限信息
     * 
     * @var array
     */
    private $userPermission;

    /**
     * set current action
     * 
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * set current controller
     * 
     * @param string $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * get current action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * get current controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * set current RouteParams
     */
    public function setRouteParams($params)
    {
        $this->routeParmas = $params;
        return $this;
    }

    /**
     * get current RouteParmas
     */
    public function getRouteParams($key = NULL)
    {
        if(!$key) return $this->routeParmas;
        return $this->routeParmas[$key];
    }

    /**
     * 
     * 取得当前的操作的功能信息
     * @return array 功能信息
     */
    public function getCurrentMCAInfo()
    {
        return $this->currentMCAInfo();
    }

    /**
     * return user permission
     */
    private function getUserPermission()
    {
        if(!$this->userPermission)
            $permission = new Permission;
            $this->userPermission = $permission->currentActive();
        return $this->userPermission;
    }

    /**
     * 当前请求所对应的功能信息
     * 
     * @return array
     */
    private function currentMCAInfo()
    {
        if(!$this->currentMCA){
            $userPermission = $this->getUserPermission();
        }
        return $this->currentMCA;
    }

    /**
     * 获取页面title
     */
    public function getTitle()
    {
        $controller = $this->controller;
        $action     = $this->action;
        if(empty($action) && !empty($title = Config::get('title.'.$controller))){
            return  $title;
        }
        if($controller && $action){
            if(!empty($title = Config::get('title.'.$controller.'.'.$action))){
                return  $title;
            }
        }
        return isset($title) ? $title : '';
    }

}