<?php

namespace App\Services;

use App\Models\Basecolor;
use App\Http\Requests;
use App\Http\Requests\BasecolorRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request,DB;

class BasecolorService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $articleModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct(Basecolor $Basecolor)
    {
        parent::__construct();
         $this->basecolorModel = new Basecolor;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->basecolorModel;
    }
    /**
     * 颜色详情
     *
     * @access public
     */
    public function getbasecolor()
    {
        $builder = $this->basecolorModel->getbasecolor();
        return $builder->paginate($pageSize);
    }

	/**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
	public function index($search, $pageSize=10)
	{   
        
        $builder = $this->basecolorModel->allContents();
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
        $data['ColorName']    = $request->ColorName;
        $data['ColorValue']  = $request->ColorValue;
        $data['Remark']      = $request->Remark;
        
        return $this->basecolorModel->editbasecolor($data , $id);

    }
     /**
     * 执行搜索颜色
     *
     * @param (arr) $data
     */
    public function action($key)
    {
    
        $result =  DB::table('basecolor')->select("*")->where('ColorName','like',"%$key%")->orderby("ColorID", "DESC")->paginate(10);
        return $result;

    }
    /**
     * 执行添加颜色
     *
     * @param (arr) $data
     */
    public function createUser($request)
    {

        $data=array();
        $data['ColorName']    = $request->ColorName;
        $data['ColorValue']  = $request->ColorValue;
        $data['Remark']      = $request->Remark;
        
        return $this->basecolorModel->addbasecolor($data);
  
    }
    /**
     * 执行删除颜色
     *
     * @param (arr) $data
     */
    public function delete($request)
    {

       return  $this->basecolorModel->delbasecolor($request);
       
     }
}