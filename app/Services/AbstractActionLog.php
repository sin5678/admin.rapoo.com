<?php 

namespace App\Services;

use App\Services\ActionLog\Mark;

/**
 * 操作日志
 */
abstract class AbstractActionLog
{	
    /**
     * 不记录改动的字段
     * 
     * @var array
     */
    public $exclude_field = [];

    /**
     * 需要比较不同的字段
     * 
     * @var array
     */
    public $diff_fields = '';
    
	/**
     * 处理方法
     * 
     * @var string
     */
    abstract public function handler();

    /**
     * 是否打开日志开关
     * 
     * @var string
     */
    protected function isLog()
    {
    	return app()->make(Mark::BIND_NAME)->isLog();
    }

    /**
     * 获取额外信息
     * 
     * @var string
     */
    protected function getExtDatas()
    {
    	return app()->make(Mark::BIND_NAME)->getExtDatas();
    }

    /**
     * 对比信息
     * 
     * @var string
     */
    protected function str_diff($text1, $text2){
        $text1 = str_replace('&nbsp;', '', trim($text1));
        $text2 = str_replace('&nbsp;', '', trim($text2));
        $w  = explode("\n", $text1);
        $o  = explode("\n", $text2);
        $w1 = array_diff_assoc($w,$o);
        $o1 = array_diff_assoc($o,$w);
        $w2 = array();
        $o2 = array();
        foreach($w1 as $idx => $val) $w2[sprintf("%03d<",$idx)] = sprintf("%03d- ", $idx+1) . "<del>" . trim($val) . "</del>";
        foreach($o1 as $idx => $val) $o2[sprintf("%03d>",$idx)] = sprintf("%03d+ ", $idx+1) . "<ins>" . trim($val) . "</ins>";
        $diff = array_merge($w2, $o2);
        ksort($diff);
        return implode("\n", $diff);
    }

    /**
     * 创建改动, 会在历史表中插入数据(没有加入事务, 包含在其他一系列操作的事务中执行)
     * @param  $old array 原始数据数组
     * @param  $new array 新数据数组
     * @return array 改动数组
     */
    public  function create_change($old, $new){
        if(empty($old)){
            return array();
        }
        $old = is_object($old)? (array)$old: $old;
        $new = is_object($new)? (array)$new: $new;

        $changes = array();
        $magic_quote = get_magic_quotes_gpc();
        // 不记录改动的字段
        //$exclude_field = array();
        // 需要比较不同的字段
        //$diff_fields = 'lang,title,public,level,description,cat_id,url,state';
        foreach($new as $key => $value) {
            if(in_array(strtolower($key), $this->exclude_field)){
                continue;
            }
            if($magic_quote){
                $value = stripslashes($value);
            }
            $old[$key] = !isset($old[$key]) ? '' : $old[$key];//如果原值是enum中的‘0’，这里会变成‘’

            if($value != stripslashes($old[$key])) {
                $diff = '';
                if(substr_count($value, "\n") > 1 or substr_count($old[$key], "\n") > 1 or strpos($this->diff_fields, strtolower($key)) !== FALSE) {
                    $diff = $this->str_diff($old[$key], $value);
                } 
                $changes[] = array('field' => $key, 'old' => $old[$key], 'new' => $value, 'diff' => $diff);
            }
        }
        return $changes;
    }

}
