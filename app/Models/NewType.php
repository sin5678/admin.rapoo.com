<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewType extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'newtype';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'NewTypeID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['NewTypeID','NewTypeCode', 'NewTypeName','NewTypeEnName','NewTypeTwName','Remark'];

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
