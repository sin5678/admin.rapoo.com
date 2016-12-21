<?php

namespace App\Http\Controllers;

use App\Services\VideoService;
use App\Services\CommonService;
use App\Services\CountryareaService;
use App\Models\Video;
use App\Models\Role;
use App\Models\InfoDistribute;
use App\Models\Permission;
use App\Http\Requests\VideoRequest;
use Illuminate\Http\Request;
use App\Services\Search\Search;
use Auth,BaseController,Form,Input,Redirect,Sentry,View,Session,Route,Entrust;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Qiniu\Data;


class VideoController  extends AbstractController
{
    /**
     * 初始化
     *
     * @param  $VideoServiceVideoService实例
     * @access public
     */
    
     private $Video;

    public function __construct(VideoService $videoService)
    {
        parent::__construct();
        $this->videoService = $videoService;
        $this->video =  new Video();
        $this->countryareaService =  new CountryareaService();
    }

    /**
     * 视频列表呈现
     */
    public function index(Search $search)
    {   
        
        $videos = $this->videoService->index($search);
     
        return View('video.index',compact('videos','videos'));
    }
     /**
     * 搜索
     *
     * @param 
     */
    public function action(Request $request)
    {
        $videos  = $this->videoService->action($request->videoname);
        
        return View('video.index',compact('videos'));
    }
        /**
     * 添加页面
     *
     * @param
     */
    public function add(Request $request) 
    {
        $areas    = $this->countryareaService->getArea();
        $areaCountrys = $this->countryareaService->getAreaCountrys();
        $countrys = $this->countryareaService->getCountry();
      //  $newTypes = $this->newTypeService->getNewType();
        return View::make('video.add',compact('countrys','areas','areaCountrys'));
    }

    /**
     * 执行添加
     *
     * @param
     */
    public function save(Data $qiniu, Request $request)
    {

        $request = $request->all();
        //如果图片没有修改就还用原来的
        if(!empty($_FILES['ThumbImg']['name']))
        {
           if($file = $qiniu->upload('ThumbImg')) $request['ThumbImg'] = $file['filePath'];
        }
            
        if($this->videoService->createVideo($request)) {

            return redirect('/video')->withErrors('创建完成');
        }
    }
    
    /**
     * 编辑页面
     *
     * @param
     */
    public function edit(Data $qiniu, Request $request, $id )
    {

        $areas    = $this->countryareaService->getArea();

        $areaCountrys = $this->countryareaService->getAreaCountrys();
        $countrys = $this->countryareaService->getCountry();
        $infoDistributes = InfoDistribute::select('CountryID')->where('InfoID','=',$id)->get()->toArray();
        $infoDistributes = array_column($infoDistributes,'CountryID');
        $video = $qiniu->prepareObjectImgData( $this->video->getvideo($id), 'ThumbImg');
        return view('video.edit')->with(['VideoID' => $id, 'video' => $video, 'areas' => $areas, 'areaCountrys' => $areaCountrys, 'countrys' => $countrys, 'infoDistributes' => $infoDistributes]);
    }
   
    

    /**
     * 编辑保存
     *
     * @param
     */
    public function store(Data $qiniu, Request $request,$id)
    {
        $request = $request->all();
         if(!empty($_FILES['ThumbImg']['name']))
        {
           if($file = $qiniu->upload('ThumbImg')) $request['ThumbImg'] = $file['filePath'];
        }

        $re = $this->videoService->store($request ,$id);

        if ($re=='0') {
            return redirect('/video')->withErrors('修改完成');
        } else {
            return Redirect::to('/video/edit/'.$id);
        }
    }


    /**
     * 删除
     *
     * @param
     */
    public function delete( Request $request )
    {
     
        $userInfo = $this->videoService->delete($request->id);
        return redirect('/video')->withErrors('删除完成');
    }



}