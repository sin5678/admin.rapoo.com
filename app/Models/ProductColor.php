<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productcolor';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'CID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    public function hasOneColorDistribute()
    {
        return $this->hasMany('\App\Models\ColorDistribute', 'CID','CID');
    }

    public function hasOneColor()
    {
        return $this->hasOne('\App\Models\BaseColor', 'ColorID','ColorID');
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
