<?php 
namespace App\Services\ActionLog\Videos;

use App\Services\AbstractActionLog;
use App\Events\ActionLog;
use Request, Lang;

/**
 * 文章操作日志
 */
class Store extends AbstractActionLog
{
    /**
     * 增加文章时的日志记录
     */
    public function handler()
    {
        if(Request::method() !== 'POST'){
            return false;
        }
        if(!$this->isLog()){
            return false;
        }
        $data = Request::all();
        if(!isset($data['title'])){
            return false;
        }
        event(new ActionLog('添加了新的视频：'.$data['title']));
    }
    
}
