<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Services\SupplyService;
use App\Http\Requests\SupplyRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;

class SupplyController extends AbstractController
{

    /**
     * 初始化
     *
     * @param  $articleService ArticleService实例
     * @access public
     */
    public function __construct(SupplyService $supplyService)
    {
        parent::__construct();
        View::share('input', Input::all());
        $this->supplyService = $supplyService;
    }

    /**
     * 文章列表呈现
     */
    public function index(Search $search)
    {   
        $supplies   = $this->supplyService->index($search);
        return View::make('supply.index',compact('supplies'));
    }

    /**
     * 添加文章页面
     */
    public function create()
    {
        $provinces = Province::all();
        return View::make('supply.create',compact('provinces'));
    }

    /**
     * 保存文章
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     */
    public function store(Data $qiniu, SupplyRequest $request)
    {   
        $request = $request->all();
        if(!$this->supplyService->processData($request)){
            return redirect('supply/create')->withErrors($this->supplyService->getErrorMessage());
        }
        return redirect('supply/index?servicetype='.$request['ServiceType']);
    }

    /**
     * 编辑文章页面
     *
     * @param int $id 文章id
     */
    public function edit( Data $qiniu, $id)
    {
        $provinces = Province::all();
        $supply = $this->supplyService->getModel()->find($id);
        return View::make('supply.edit', compact('supply','provinces'));
    }

    /**
     * 修改文章保存
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * @param int $id 文章id
     */
    public function update(Data $qiniu, SupplyRequest $request, $id)
    {   
        $request = $request->all();
        if(!$this->supplyService->processData($request, $id)){
            return redirect('supply/edit/'.$id)->withErrors($this->supplyService->getErrorMessage());
        }
        return redirect('supply/index?servicetype='.$request['ServiceType']);
    }

    /**
     * 删除
     *
     * @param void
     */
    public function delete(Data $qiniu)
    {   
        if($articles = $this->supplyService->processDeleteData(Input::get('id'))){
            return redirect('supply/index?servicetype=1');
        } 
    }
}