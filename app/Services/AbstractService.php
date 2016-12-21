<?php 
namespace App\Services;

use App\Services\CommonService;
use Route,Config,View,Input,Auth;

/**
 * 服务基类
 */
class AbstractService
{
    /**
     * 错误的信息载体
     */
    protected $errorMsg;
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {

    }
    /**
     * 取回错误的信息
     */
    public function getErrorMessage()
    {
        return $this->errorMsg;
    }
    /**
     * 设置错误的信息
     *
     * @param string $errorMsg 错误的信息
     */
    public function setErrorMsg($errorMsg)
    {
    	$this->errorMsg = $errorMsg;
    	return false;
    }
      
}