<?php

namespace App\Models;

use App\Models\Base;
use App\Models\SiteSpellDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\Qiniu\Data;
use Request;


class SiteSpell extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sitespell';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'SiteID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['SiteID','Title', 'ImgUrl','LinkUrl','ProfileDesc','IsDisable','ExpireTime','Remark','StyleXml','OrderNo','Target'];

    /**
     * 获取相应条件的文章列表
     *
     * @param object $query
     * @param  int  $pageSize 每页文章条数
     * @return array
     */
    
    public function allContents()
    {
        //$currentQuery = $this->select('*');
        //return $currentQuery;

        $currentQuery = $this->select('sitespell.*','sitespelldetail.Language')
                        ->leftJoin('sitespelldetail', 'sitespell.SiteID', '=', 'sitespelldetail.SiteID')
                        ->orderBy('sitespell.SiteID','desc');
        return $currentQuery;
    }

    /**
     * 模型事件
     */
    public static function boot()
    {
        parent::boot();
        static::updated (function($sitespell)
        {
            $qiniu = new Data;
            $qiniuDisk = $qiniu->getDisk();
            $sitespell['original']['ImgUrl'] && $qiniuDisk->exists($sitespell['original']['ImgUrl']) && $qiniuDisk->delete($sitespell['original']['ImgUrl']);
            SiteSpellDetail::where('SiteID','=',$sitespell->SiteID)->delete();

            $data = Request::all();
            SiteSpellDetail::insert(['SiteID' => $sitespell->SiteID , 'Language' => $data['Language']]);


        });

        static::created (function($sitespell)
        {
            $data = Request::all();
            SiteSpellDetail::insert(['SiteID' => $sitespell->SiteID , 'Language' => $data['Language']]);
        });

        static::deleted(function($sitespell){
            SiteSpellDetail::where('SiteID','=',$sitespell->SiteID)->delete();
        });
    }
}
