<?php

namespace App\Services;

use App\Models\Logfail;
use App\Services\BaseService;
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class LogfailService extends BaseService
{
    const FAIL_NUM = 10;
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 判断登录失败次数
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function getFailIp($ip)
    {
        $result = Logfail::where(['ip' => $ip])->where('num', '>=', self::FAIL_NUM)->where('updated_at', '>=', date('Y-m-d'))->count();
        if ($result > 0) {
            return true;
        }
        return false;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getcaptcha($tmp)
    {

        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::set('milkcaptcha', $phrase);
        //header("Cache-Control: no-cache, must-revalidate");
        // header('Content-Type: image/jpeg');
        //  echo $tmp;exit;
        // var_dump($builder->inline());
        // $builder->output();
        return $builder->inline();
    }

    public function setIpLogFail($ip, $result = true)
    {
        if ($result) {
            if ($logfail = Logfail::where(['ip' => $ip])->first()) {
                $arr['num']        = 0;
                $arr['updated_at'] = date('Y-m-d');
                Logfail::where(['ip' => $ip])->update($arr);
                return true;
            }
            return true;
        }
        if ($logfail = Logfail::where(['ip' => $ip])->first()) {
            if ($logfail->updated_at >= date('Y-m-d')) {
                $arr['num'] = $logfail->num + 1;
            } else {
                $arr['num'] = 1;
            }
            $arr['updated_at'] = date('Y-m-d');
            Logfail::where(['ip' => $ip])->update($arr);
            return true;

        } else {
            $arr['ip']         = $ip;
            $arr['num']        = 1;
            $arr['updated_at'] = date('Y-m-d');
            Logfail::create($arr);
            return true;
        }
    }

}
