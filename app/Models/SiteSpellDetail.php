<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSpellDetail extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sitespelldetail';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'DetailID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['DetailID','ProfileDesc', 'Language','SiteID'];

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
}
