<?php 
namespace App\Services\ActionLog\Categories;

use App\Services\AbstractActionLog;
use App\Events\ActionLog;
use Request, Lang; 

/**
 * 分类操作日志
 */
class Delete extends AbstractActionLog
{
    /**
     * 删除分类时的日志记录
     */
    public function handler()
    {
        if(!$this->isLog()){
            return false;
        }
        $extDatas = $this->getExtDatas();
        if(!isset($extDatas['category'])) return false;
        if(empty($extDatas['category'])) return false;
        event(new ActionLog('删除分类：'.$extDatas['category'][0]->title));
    }
    
}
