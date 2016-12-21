<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'joinus';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'JoinID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['Position','DeptName', 'Number','Content','ContactUser','ContactPhone','Addr','Email','WorkExperience','Expire','WorkPlace','Salary','IsDelete','CreateTime','Remark'];

    /**
     * 获取相应条件的文章列表
     *
     * @param object $query
     * @param  int  $pageSize 每页文章条数
     * @return array
     */
    
    public function allContents()
    {
        $currentQuery = $this->select('*')->orderBy('JoinID','desc');
        return $currentQuery;
    }
}
