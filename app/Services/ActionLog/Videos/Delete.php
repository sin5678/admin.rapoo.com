<?php 
namespace App\Services\ActionLog\Videos;

use App\Services\AbstractActionLog;
use App\Events\ActionLog;
use Request, Lang; 

/**
 * 视频操作日志
 */
class Delete extends AbstractActionLog
{
    /**
     * 删除视频时的日志记录
     */
    public function handler()
    {
        if(!$this->isLog()){
            return false;
        }
        $extDatas = $this->getExtDatas();
        if(!isset($extDatas['videos'])) return false;
        if(empty($extDatas['videos'])) return false;
        event(new ActionLog('删除视频：'.$extDatas['videos'][0]->title));
    }
    
}
