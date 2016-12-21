<?php 
namespace App\Services\ActionLog\Categories;

use App\Services\AbstractActionLog;
use App\Events\ActionLog;
use Request, Lang;

/**
 * 分类操作日志
 */
class Update extends AbstractActionLog
{
    // 不记录改动的字段
    public $exclude_field = [];
    // 需要比较不同的字段
    public $diff_fields = 'lang,title,alias,description,parent_id,published,meta_keywords,meta_desc';

    /**
     * 修改分类时的日志记录
     */
    public function handler()
    {
        if(Request::method() !== 'POST'){
            return false;
        }
        if(!$this->isLog()){
            return false;
        }
        $extDatas = $this->getExtDatas();
        $data = Request::all();
        if(!isset($data['title'])){
            return false;
        }
        $id = $data['id'];
        unset($data['id']);
        $change = $this->create_change($extDatas, $data);
        $message = '';
        foreach($change as $key => $value){
            $diff = [];
            if($value['diff']){
                $diff[] = 'key => '.$value['field'];
                $diff[] = 'old => '.$value['old'];
                $diff[] = 'new => '.$value['new']."<br>";
            }
            $message .= implode(',', $diff);
        }
        event(new ActionLog('更新分类ID:'.$id.'<br>'.$message));
    }
    
}
