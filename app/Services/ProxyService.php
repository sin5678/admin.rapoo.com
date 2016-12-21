<?php

namespace App\Services;

use App\Models\Proxy;
use App\Http\Requests;
use App\Http\Requests\SupplyRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class ProxyService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $proxyModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->proxyModel = new Proxy;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->proxyModel;
    }

    /**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->proxyModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }
    
    
   public function getWebSiteType()
   {
   		
   		return  $webSiteTypeArr = [
    		
    		1=>'代理商网店',
    		2=>'直销电商网店',
    		3=>'雷柏直属合作B2C商城',
    		4=>'雷柏线下体验店',
    		5=>'In Store',
    		6=>'Online',
    		7=>'Distributor'
    	];
   }
   
   public function getArea()
   {
   		 return $areaArr 		= [
    		0=>'电商直销商网店',
    		1=>'华北大区',
    		2=>'华东大区',
    		3=>'华南大区',
    		4=>'华中大区',
    		5=>'华西大区',
    		6=>'KA代理',
    		 
    		8=>'大中华地区',
    		9=>'欧洲',
    		10=>'南美洲',
    		11=>'北美洲',
    		12=>'非洲地区',
    		13=>'KA代理商',
    		 
    ];
   }
   
}