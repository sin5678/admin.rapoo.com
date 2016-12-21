<?php 
namespace App\Services\ActionLog\Articles;

use App\Services\AbstractActionLog;
use App\Events\ActionLog;
use Request, Lang; 

/**
 * 文章操作日志
 */
class Delete extends AbstractActionLog
{
    /**
     * 删除文章时的日志记录
     */
    public function handler()
    {
        if(!$this->isLog()){
            return false;
        }
        $extDatas = $this->getExtDatas();
        if(!isset($extDatas['articles'])) return false;
        if(empty($extDatas['articles'])) return false;
        event(new ActionLog('删除文章：'.$extDatas['articles'][0]->title));
    }
    
}
