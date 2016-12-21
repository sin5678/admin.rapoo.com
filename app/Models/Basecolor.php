<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\Qiniu\Data;

class Basecolor extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'basecolor';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'ColorID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ColorID','ColorName', 'ColorValue','Remark'];

    
    /**
     * 获取相应条件的YANS列表
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
     * 取得指定uid的信息
     * 
     * @param string $uid 用户ID
     * @return array
     */
    public function getbasecolor($ColorID)
    {
        return $this->where('ColorID', '=', $ColorID)->get()->first();
    }
    /**
     * 修改颜色值
     *  
     * @param array $data 所需要修改的信息
     */
    public function editbasecolor(array $data, $id)
    {
        return $this->where('ColorID', '=', intval($id))->update($data);
    }
    /**
     * 添加颜色值
     *  
     * @param array $data 所需要添加的信息
     */
    public function addbasecolor(array $data)
    {
          $addbasecolor = $this->firstOrCreate($data);
        return $addbasecolor->id;
    }
    /**
     * 删除颜色值
     *  
     * @param array $ID 所需要添加的信息
     */
    public function delbasecolor($id)
    {
         return $this->whereIn('ColorID', $id)->delete();

    }
}
