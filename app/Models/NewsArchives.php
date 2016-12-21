<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsArchives extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'newsarchives';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ArchivesID','NewID'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

    public function hasOneNew()
    {
        return $this->hasOne('\App\Models\Article', 'NewID', 'NewID');
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
}
