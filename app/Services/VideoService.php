<?php

namespace App\Services;

use App\Models\Video;
use App\Http\Requests;
use App\Models\InfoDistribute;
use App\Http\Requests\VideoRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request,DB;

class VideoService extends BaseService
{
    

    /**
     * 初始化
     *
     * @access public
     */
    public function __construct(Video $Video)
    {
        
         parent::__construct();
         $this->videoModel = new Video;
      
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->videoModel;
    }
 
    /**
     * 视频列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->videoModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }
     /**
     * 执行编辑颜色
     *
     * @param (arr) $data
     */
    public function store($request,$id)
    {
    
        $data=array();
        $data['VideoName']    = $request['VideoName'];
        $data['VideoType']  = $request['VideoType'];
        $data['VideoPath']  = $request['VideoPath'];
        $data['VideoDesc']  = $request['VideoDesc'];
        $data['VideoAthor']  = $request['VideoAthor'];
        $data['Remark']      = $request['Remark'];
        $datb['txtCountryName']      = $request['txtCountryName'];

         InfoDistribute::where('InfoID','=',$id)->delete();

        if($datb['txtCountryName']){
            foreach($datb['txtCountryName'] as  $key => $value){
                list($CountryID, $CountryName) = explode(',', $value);
                $arr[$key]['CountryID'] = $CountryID;
                $arr[$key]['Country'] = $CountryName;
                $arr[$key]['InfoID'] = $id;
                $arr[$key]['InfoType'] = '4';
            }
            InfoDistribute::insert($arr);
        }

        return $this->videoModel->editvideo($data , $id);

    }

     /**
     * 执行搜索视频
     *
     * @param (arr) $data
     */
    public function action($key)
    {
    
        $result =  DB::table('videomgr')->select("*")->where('VideoName','like',"%$key%")->orderby("VideoID", "DESC")->paginate(10);
        return $result;

    }
    /**
     * 执行添加颜色
     *
     * @param (arr) $data
     */
    public function createVideo($request)
    {
        
        $data=array();
        $data['VideoName']    = $request['VideoName'];
        $data['VideoType']  = $request['VideoType'];
        $data['VideoPath']  = $request['VideoPath'];
        $data['VideoDesc']  = $request['VideoDesc'];
        $data['ThumbImg']  = $request['ThumbImg'];
        $data['VideoAthor']  = $request['VideoAthor'];
        $data['Remark']      = $request['Remark'];
        $datb['txtCountryName']      = $request['txtCountryName'];

         $VideoID = $this->videoModel->addvideo($data);

          if($datb['txtCountryName']){
            foreach($datb['txtCountryName'] as  $key => $value){
                list($CountryID, $CountryName) = explode(',', $value);
                $arr[$key]['CountryID'] = $CountryID;
                $arr[$key]['Country'] = $CountryName;
                $arr[$key]['InfoID'] = $VideoID;
                $arr[$key]['InfoType'] = '4';
            }
          return  InfoDistribute::insert($arr);
         }
  
    }
    /**
     * 执行删除颜色
     *
     * @param (arr) $data
     */
    public function delete($request)
    {

       return  $this->videoModel->delvideo($request);
       
     }
}