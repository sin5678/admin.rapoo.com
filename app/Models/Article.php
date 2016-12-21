<?php

namespace App\Models;

use App\Models\Base;
use App\Models\InfoDistribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\Qiniu\Data;
use Request;

class Article extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'NewID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['NewID','title', 'ProfileImg','content','ActiveTime','CreateTime','ExpireTime','IsAudit','NewType','IsArchives','Remark'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

    public function hasOneCategory()
    {
        return $this->hasOne('\App\Http\Models\Category', 'cat_id', 'id');
    }

    /**
     * 获取相应条件的文章列表
     *
     * @param object $query
     * @param  int  $pageSize 每页文章条数
     * @return array
     */
    
    public function allContents()
    {
        $currentQuery = $this->select('*');
        return $currentQuery;
    }

    /**
     * 模型事件
     */
    public static function boot()
    {
        parent::boot();
        static::updated (function($article)
        {
            $qiniu = new Data;
            $qiniuDisk = $qiniu->getDisk();
            $article['original']['ProfileImg'] && $qiniuDisk->exists($article['original']['ProfileImg']) && $qiniuDisk->delete($article['original']['ProfileImg']);
            InfoDistribute::where('InfoID','=',$article->NewID)->delete();

            $data = Request::all();
            if(isset($data['txtCountryName'])){
                foreach($data['txtCountryName'] as  $key => $value){
                    list($CountryID, $CountryName) = explode(',', $value);
                    $arr[$key]['CountryID'] = $CountryID;
                    $arr[$key]['Country'] = $CountryName;
                    $arr[$key]['InfoID'] = $article->NewID;
                    $arr[$key]['InfoType'] = '2';
                }
                InfoDistribute::insert($arr);
            }

        });

        static::created (function($article)
        {
            $data = Request::all();
            if(isset($data['txtCountryName'])){
                foreach($data['txtCountryName'] as  $key => $value){
                    list($CountryID, $CountryName) = explode(',', $value);
                    $arr[$key]['CountryID'] = $CountryID;
                    $arr[$key]['Country'] = $CountryName;
                    $arr[$key]['InfoID'] = $article->NewID;
                    $arr[$key]['InfoType'] = '2';
                }
                InfoDistribute::insert($arr);
            }
        });

        static::deleted(function($article){
            InfoDistribute::where('InfoID','=',$article->NewID)->delete();
        });
    }
}
