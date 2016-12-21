<?php

namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTranslate extends Base
{
  
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'producttranslate';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'TranslateID';

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['TranslateID','PID', 'Language','ProductName', 'Remark','ProductDesc', 'ProductShow','ProductStandard','ProductShowJSON','region'];

   
    /**
     * 获取指定ID翻译信息
     * 
     * @param intval $id 翻译ID
     * @return array
     */
    public function getOneById($id)
    {
        return $this->where('TranslateID', '=', intval($id))->first();
    }
    /**
     * 获取相应条件的翻译列表呈现
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
     * 取得指定翻译ID的信息
     * 
     * @param string $uid 翻译ID
     * @return array
     */
    public function getProductTranslate($id,$Language='zh-CN')
    {
        return $this->where( ['PID'=>$id ,'Language'=>$Language] )->get()->first();
    }
      /**
     * 取得对应同地区翻译的信息
     * 
     * @param string $uid 翻译ID
     * @return array
     */
    public function getregionTranslate($id,$Language='zh-CN')
    {
        return $this->where( ['PID'=>$id ,'region'=>$Language] )->lists('Language')->toArray();
    }
    /**
     * 修改翻译值
     *  
     * @param array $data 所需要修改的信息
     */
    public function editProductTranslate(array $data, $id)
    {  
        return $this->where('TranslateID', '=', intval($id))->update($data);

    }
    /**
     * 添加翻译值
     *  
     * @param array $data 所需要添加的信息
     */
    public function addProductTranslate(array $data)
    { 

        $addProductTranslate = $this->firstOrCreate($data);
        return $addProductTranslate->TranslateID;
    }
    /**
     * 删除翻译值
     *  
     * @param array $ID 所需要删除的信息
     */
    public function delProductTranslate($id)
    {
         return $this->whereIn('TranslateID', $id)->delete();

    }
     /**
     * 翻译多条件删除
     *  
     * @param array $ID 所需要删除的信息
     */
    public function delTranslate($pid,$region)
    {
         return $this->where("PID","=",$pid)->where("region","=",$region)->delete();

    }
}
