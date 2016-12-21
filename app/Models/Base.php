<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Auth, Cache;
/**
 * 模型基类
 */
class Base extends Model
{
    /**
     * 每页多少
     *
     * @var int
     */
    CONST PAGE_NUMS = 10;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $timestamps = false;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_date', 'modified_date'];


    protected $cacheMinutes = 1440;

    /**
     * 填充数据
     * 
     * @param array $data
     * @return array
     */
    public function fillInsertData(array $data)
    {
        $data['created_date']    = date("Y-m-d H:i:s");
        $data['modified_date']   = date("Y-m-d H:i:s");
        $data['created_by']      = Auth::user()->id;
        $data['modified_by']     = Auth::user()->id;
        return $data;
    }

    /**
     * 填充数据
     * 
     * @param array $data
     * @return array
     */
    public function fillEditData(array $data)
    {
        $data['modified_date']   = date("Y-m-d H:i:s");
        $data['modified_by']     = Auth::user()->id;
        return $data;
    }

    /**
     * 根据主键查找
     * 
     * @param mix $ids
     * @return false|array
     */
    public function hget($ids, $indexKey = false)
    {
        $idArr = $this->string2array($ids);
        $data = [];
        foreach ($idArr as $key => $value) {
            if (empty($data[$value] = Cache::get($key = $this->cacheName . $value))) {
                $data[$value] = $this->find($value);
                Cache::add($key, $data[$value], $this->cacheMinutes);
            }
        }
        !$indexKey && $indexKey = $this->primaryKey;
        foreach($data as $k => $v){
            if($ik = $v->$indexKey) { 
                $arr[$ik] = $v;
            }
        }
        if(count($idArr) == 1) return $data[$ids];
        return $arr;
    }

    /**
     * 主键转换
     */
    public function string2array($ids)
    {
        if(!$ids) return [];
            if(!is_array($ids) && strpos($ids, ',') === false){
            $idArr = [intval($ids)];
        } else {
            $idArr = is_array($ids) ? $ids : (strpos($ids,',') !== false ? explode(',',$ids) : []);
        }
        return $idArr = array_map('intval', $idArr);
    }
    
}
