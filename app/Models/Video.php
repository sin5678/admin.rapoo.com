<?php

namespace App\Models;
use App\Models\Base;
use App\Models\InfoDistribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Base
{
  
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'videomgr';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'VideoID';

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['VideoID','VideoName', 'VideoType','VideoPath', 'VideoDesc','ThumbImg', 'VideoAthor','CreateTime','ExpireTime','Remark'];

   
    /**
     * 获取指定ID视频信息
     * 
     * @param intval $id 视频ID
     * @return array
     */
    public function getOneById($id)
    {
        return $this->where('id', '=', intval($id))->first();
    }
    /**
     * 获取相应条件的视频列表呈现
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
     * 取得指定视频ID的信息
     * 
     * @param string $uid 视频ID
     * @return array
     */
    public function getvideo($id)
    {
        return $this->where('VideoID', '=', $id)->get()->first();
    }
    /**
     * 修改视频值
     *  
     * @param array $data 所需要修改的信息
     */
    public function editvideo(array $data, $id)
    {
        return $this->where('VideoID', '=', intval($id))->update($data);
    }
    /**
     * 添加视频值
     *  
     * @param array $data 所需要添加的信息
     */
    public function addvideo(array $data)
    { 

        $addvideo = $this->firstOrCreate($data);

        return $addvideo->VideoID;
    }
    /**
     * 删除视频值
     *  
     * @param array $ID 所需要删除的信息
     */
    public function delvideo($id)
    {
         return $this->whereIn('VideoID', $id)->delete();

    }
}
