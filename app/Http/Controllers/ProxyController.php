<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Services\ProxyService;
use App\Http\Requests\ProxyRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;
use App\Models\Country;

class ProxyController extends AbstractController
{
	
    /**
     * 初始化
     *
     * @param  $articleService ArticleService实例
     * @access public
     */
	
	
    public function __construct(ProxyService $proxyService)
    {
        parent::__construct();
        View::share('input', Input::all());
        $this->proxyService = $proxyService;
    }

    /**
     * 文章列表呈现
     */
    public function index(Search $search)
    {   
    	$webSiteTypeArr = $this->proxyService->getWebSiteType();
    	$areaArr 		= $this->proxyService->getArea();
    	
    	
        $list   = $this->proxyService->index($search);
        return View::make('proxy.index',compact('list','webSiteTypeArr','areaArr'));
    }

    
    /**
     * 添加文章页面
     */
    public function create()
    {
        $webSiteTypeArr = $this->proxyService->getWebSiteType();
    	$areaArr 		= $this->proxyService->getArea();
    	$countryList    = Country::all();
        return View::make('proxy.create',compact('webSiteTypeArr','areaArr','countryList'));
    }

    /**
     * 保存文章
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     */
    public function store(Data $qiniu, ProxyRequest $request)
    {   
        $request = $request->all();
        if($file = $qiniu->upload('Icon'))    $request['Icon'] = $file['filePath'];
        if($file = $qiniu->upload('ShowImg')) $request['ShowImg'] = $file['filePath'];
        if(!$this->proxyService->processData($request)){
            return redirect('proxy/create')->withErrors($this->proxyService->getErrorMessage());
        }
        return redirect('proxy/index');
    }

    /**
     * 编辑文章页面
     *
     * @param int $id 文章id
     */
    public function edit( Data $qiniu, $id)
    {
        $webSiteTypeArr = $this->proxyService->getWebSiteType();
    	$areaArr 		= $this->proxyService->getArea();
    	$countryList    = Country::all();
    	$record = $qiniu->prepareObjectImgData($this->proxyService->getModel()->find($id), 'Icon');
    	$record = $qiniu->prepareObjectImgData($record, 'ShowImg');
        return View::make('proxy.edit', compact('webSiteTypeArr','areaArr','record','countryList'));
    }

    /**
     * 修改文章保存
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * @param int $id 文章id
     */
    public function update(Data $qiniu, ProxyRequest $request, $id)
    {   
        $request = $request->all();
        if($file = $qiniu->upload('Icon'))    $request['Icon'] = $file['filePath'];
        if($file = $qiniu->upload('ShowImg')) $request['ShowImg'] = $file['filePath'];
        if(!$this->proxyService->processData($request, $id)){
            return redirect('/proxy/edit/'.$id)->withErrors($this->proxyService->getErrorMessage());
        }
        return redirect('/proxy/index');
    }

    /**
     * 删除
     *
     * @param void
     */
    public function delete(Data $qiniu)
    {   
        if($articles = $this->proxyService->processDeleteData(Input::get('id'))){
            return redirect('proxy/index');
        } 
    }
}