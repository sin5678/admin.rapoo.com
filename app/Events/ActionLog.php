<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Auth;

class ActionLog extends Event
{
    use SerializesModels;

    /**
     * 所要记录的操作日志信息
     * 
     * @var string
     */
    public $message;

    /**
     * 当前登录的用户ID
     * 
     * @var int
     */
    public $userId;

    /**
     * 当前登录的用户名
     * 
     * @var string
     */
    public $userName;

    /**
     * 当前登录的真实姓名
     * 
     * @var string
     */
    public $realName;

    /**
     * 创建一个事件实例
     *
     * @return void
     */
    public function __construct($message, $extendsDatas = [])
    {
        $userInfo = !isset($extendsDatas['userInfo']) ?  Auth::user() : $extendsDatas['userInfo'];
        if(isset($userInfo->id)){
            $this->userId = $userInfo->id;
        } 
        if(isset($userInfo->account)){
            $this->userName = $userInfo->account;
        }
        if(isset($userInfo->real_name)){
            $this->realName = $userInfo->real_name;
        }
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
