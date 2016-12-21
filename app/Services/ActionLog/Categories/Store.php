<?php 
namespace App\Services\ActionLog\Categories;

use App\Services\AbstractActionLog;
use App\Events\ActionLog;
use Request, Lang;

/**
 * 分类操作日志
 */
class Store extends AbstractActionLog
{
    /**
     * 增加分类时的日志记录
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
        event(new ActionLog('添加分类：'.$data['title']));
    }
    
}
