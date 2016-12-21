<?php 
namespace App\Services\ActionLog\Auth\Auth;

use App\Services\AbstractActionLog;
use App\Events\ActionLog;
use Request, Lang;

/**
 * 系统登录日志
 */
class PostLogin extends AbstractActionLog
{
    /**
     * 系统登录日志
     */
    public function handler()
    {
        if(Request::method() !== 'POST'){
            return false;
        }
        if(!$this->isLog()){
            return false;
        }
        event(new ActionLog('登录系统成功'));
    }
    
}
