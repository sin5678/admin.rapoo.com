<?php

namespace App\Http\Controllers;

use App\Services\ProductTranslateService;
use App\Services\ProductService as ProductService;
use App\Services\CommonService;
use App\Services\LangsService;
use App\Models\ProductTranslate;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\ProductTranslateRequest;
use Illuminate\Http\Request;
use App\Services\Search\Search;
use Illuminate\Support\Facades\View;
use Auth,BaseController,Form,Input,Redirect,Sentry,Session,Route,Entrust;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Qiniu\Data  as Data;

class ProductTranslateController  extends AbstractController
{
    /**
     * 初始化
     *
     * @param  $ProductTranslateServiceProductTranslateService实例
     * @access public
     */
    
     private $ProductTranslate;
     private $ProductService;
     private $LangsService;

    public function __construct(ProductTranslateService $ProductTranslateService)
    {
        parent::__construct();
        $this->ProductTranslateService = $ProductTranslateService;
        $this->ProductTranslate =  new ProductTranslate();
        $this->ProductService =  new ProductService();
        $this->LangsService =  new LangsService();
    }

    /**
     * 翻译列表呈现
     */
    public function index(Search $search)
    {   
        
       $productList=$this->ProductService->getList();
         return view('ProductTranslate.index')->with("list",$productList)->with('keyword','');
    }
    /*
    *搜索产品
    */
     public function  action(Request $request)
    {
       $action = $request->input('action');

        if($action=='search') {
            $productList = $this->ProductService->getSearchList($request->input('keyword'));
            return view('ProductTranslate.index')->with("list", $productList)->with('keyword', $request->input('keyword'));
        }
    }

        /**
     * 添加页面
     *
     * @param
     */
    public function add(Request $request) 
    {
    
         return view('ProductTranslate.add');
    }

    /**
     * 执行添加
     *
     * @param
     */
    public function save(Request $request)
    {

       if($this->ProductTranslateService->createProductTranslate($request)){
            return redirect('/ProductTranslate/index')->withErrors('颜色创建完成');
        }
    }
    
    /**
     * 编辑页面
     *
     * @param
     */
    public function edit( Request $request, $id )
    {

        $Language = 'zh-CN';
        $Language = $request->all()?$request->all()['Language']:$Language;
        $region = $this->ProductTranslate->getregionTranslate($id,$Language);
       
        $ProductTranslate = $this->ProductTranslate->getProductTranslate($id,$Language);
        $Producten = $this->ProductTranslate->getProductTranslate($id,'en-US');
        $product = $this->ProductService->getProduct($id); //获取产品信息
        $dataList = $this->LangsService->getcountry(); //获取国家信息


        $productStardard =[];
        $productShowJSON =[];

        if (!empty($product->ProductStandard)) {
            $productStardard = unserialize(base64_decode($product->ProductStandard));
        }

        if(!empty($ProductTranslate->ProductShowJSON)) {
           
                $productShowJSON = unserialize(base64_decode($ProductTranslate->ProductShowJSON));
        } else if(!empty($product->ProductShowJSON)) {
            
            $productShowJSON = unserialize(base64_decode($product->ProductShowJSON));
        }


        return view('ProductTranslate.edit')->with(['PID' => $id,'ProductTranslate' => $ProductTranslate, 'Product' => $product, 'dataList' => $dataList])
            ->with('productStardard',$productStardard)
            ->with('Language',$Language)
            ->with('region',$region)
			->with('Producten',$Producten)
            ->with('maidian',$productShowJSON);
    }
   
    

    /**
     * 编辑保存
     *
     * @param
     */
    public function store( Request $request,  Data $qiniu )
    {

        //$re = $this->ProductTranslateService->store($request ,$id);
        //
        
        if(!empty($request->input()['TranslateID'])) {
            $re = $this->ProductTranslateService->store($request->input(),$qiniu);
             return redirect('/producttranslate')->withErrors('保存完成');
        } else {

            $re = $this->ProductTranslateService->createProductTranslate($request->input(),$qiniu);
             return redirect('/producttranslate')->withErrors('保存完成');
        }
      
    }


    /**
     * 删除
     *
     * @param
     */
    public function delete( Request $request )
    {
     
        $userInfo = $this->ProductTranslateService->delete($request->id);
        return redirect('/ProductTranslate/index')->withErrors('删除完成');
    }



}