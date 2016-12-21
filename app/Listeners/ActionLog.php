<?php

namespace App\Listeners;

use App\Events\ActionLog as EventsActionLog;

use App\Models\ActionLog as ActionLogModel;
use Request;

class ActionLog
{
    /**
     * 日志模型
     * @var object
     */
    private $model;

    /**
     * 初始化
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->model = new ActionLogModel();
    }

    /**
     * 处理事件
     *
     * @param  EventsActionLog  $event
     * @return void
     */
    public function handle(EventsActionLog $event)
    {
        $addDatas['username']   = $event->userName;
        $addDatas['user_id']    = $event->userId;
        $addDatas['ip']         = Request::ip();
        $addDatas['ip_adress']  = '';
        $addDatas['add_time']   = date('Y-m-d H:i:s');
        $addDatas['realname']   = $event->realName;
        $addDatas['content']    = $event->message;
        $this->model->create($addDatas);
    }
}
