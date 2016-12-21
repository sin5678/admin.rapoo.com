<?php 
namespace App\Models;

use App\Models\Base;

/**
 * 操作日志表模型
 */
class ActionLog extends Base
{
    /**
     * 操作日志数据表名
     *
     * @var string
     */
    protected $table = 'action_log';

    /**
     * 可以被集体附值的表的字段
     *
     * @var string
     */
    protected $fillable = array('id', 'username', 'user_id', 'ip', 'ip_adress', 'add_time', 'realname', 'content');
    
    /**
     * 增加操作日志
     * 
     * @param array $data 所需要插入的信息
     */
    public function add(array $data)
    {
        return $this->create($data);
    }

    /**
     * 取得所有的日志
     *
     * @return array
     */
    public function allContents()
    {
        $currentQuery = $this->orderBy('id', 'desc');
        return $currentQuery;
    }

}
