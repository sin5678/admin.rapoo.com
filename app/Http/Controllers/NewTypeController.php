<?php

namespace App\Http\Controllers;

use App\Services\NewTypeService;
use App\Http\Requests\NewTypeRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;

class NewTypeController extends AbstractController
{

    /**
     * 初始化
     *
     * @param  $articleService ArticleService实例
     * @access public
     */
    public function __construct(NewTypeService $newTypeService)
    {
        parent::__construct();
        $this->newTypeService = $newTypeService;
    }

    /**
     * 文章列表呈现
     */
    public function index(Search $search)
    {   
        $newTypes   = $this->newTypeService->index($search);
        return View::make('newtype.index',compact('newTypes'));
    }

    /**
     * 添加文章页面
     */
    public function create()
    {
        return View::make('newtype.create');
    }

    /**
     * 保存文章
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     */
    public function store(Data $qiniu, NewTypeRequest $request)
    {   
        $request = $request->all();
        if(!$this->newTypeService->processData($request)){
            return redirect('newtype/create')->withErrors($this->articleService->getErrorMessage());
        }
        return redirect('newtype/index');
    }

    /**
     * 编辑文章页面
     *
     * @param int $id 文章id
     */
    public function edit( Data $qiniu, $id)
    {
        $newType = $this->newTypeService->getModel()->find($id);
        return View::make('newtype.edit', compact('newType'));
    }

    /**
     * 修改文章保存
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * @param int $id 文章id
     */
    public function update(Data $qiniu, NewTypeRequest $request, $id)
    {   
        $request = $request->all();
        if(!$this->newTypeService->processData($request, $id)){
            return redirect('newtype/edit/'.$id)->withErrors($this->newTypeService->getErrorMessage());
        }
        return redirect('newtype/index');
    }

    /**
     * 删除
     *
     * @param void
     */
    public function delete(Data $qiniu)
    {   
        if($articles = $this->newTypeService->processDeleteData(Input::get('id'))){
            return redirect('newtype/index');
        } 
    }
}