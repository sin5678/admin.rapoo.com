<?php

namespace App\Http\Controllers;

use App\Services\DocumentTypeService;
use App\Http\Requests\DocumentTypeRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;

class DocumentTypeController extends AbstractController
{

    /**
     * 初始化
     *
     * @param  $articleService ArticleService实例
     * @access public
     */
    public function __construct(DocumentTypeService $documentTypeService)
    {
        parent::__construct();
        $this->documentTypeService = $documentTypeService;
    }

    /**
     * 文章列表呈现
     */
    public function index(Search $search)
    {   
        $documentTypes   = $this->documentTypeService->index($search);
        return View::make('documenttype.index',compact('documentTypes'));
    }

    /**
     * 添加文章页面
     */
    public function create()
    {
        return View::make('documenttype.create');
    }

    /**
     * 保存文章
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     */
    public function store(Data $qiniu, DocumentTypeRequest $request)
    {   
        $request = $request->all();
        if(!$this->documentTypeService->processData($request)){
            return redirect('documenttype/create')->withErrors($this->documentTypeService->getErrorMessage());
        }
        return redirect('documenttype/index');
    }

    /**
     * 编辑文章页面
     *
     * @param int $id 文章id
     */
    public function edit( Data $qiniu, $id)
    {
        $documentType = $this->documentTypeService->getModel()->find($id);
        return View::make('documenttype.edit', compact('documentType'));
    }

    /**
     * 修改文章保存
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * @param int $id 文章id
     */
    public function update(Data $qiniu, DocumentTypeRequest $request, $id)
    {   
        $request = $request->all();
        if(!$this->documentTypeService->processData($request, $id)){
            return redirect('documenttype/edit/'.$id)->withErrors($this->documentTypeService->getErrorMessage());
        }
        return redirect('documenttype/index');
    }

    /**
     * 删除
     *
     * @param void
     */
    public function delete(Data $qiniu)
    {   
        if($this->documentTypeService->processDeleteData(Input::get('id'))){
            return redirect('documenttype/index');
        } 
    }
}