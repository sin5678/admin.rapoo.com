<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proxy extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proxy';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'ProxyID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ProxyID','WebsiteType', 'Area','CompanyName',
    		'CompanyUrl','CompanyDetail','Phone','Fax','lng','lat','CompanyAddr',
    		'CompanyShortAddr','ShowImg','Language','Icon','Email',];

    /**
     * 获取相应条件的文章列表
     *
     * @param object $query
     * @param  int  $pageSize 每页文章条数
     * @return array
     */
    
    public function allContents()
    {
        $currentQuery = $this->select('*')->orderBy('ProxyID','desc');
        return $currentQuery;
    }
}
