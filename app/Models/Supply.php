<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supply extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'ServiceID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ServiceID','ProvinceID', 'Contact','ContactPhone','Addr','CompanyName','ShortName','Email','lng','lat','ServiceType','IsDisable'];

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
        $currentQuery = $this->select('services.*','province.ProvinceName')
                        ->leftJoin('province', 'services.ProvinceID', '=', 'province.ProvinceID')
                        ->orderBy('services.ServiceID','desc');
        return $currentQuery;
    }
}
