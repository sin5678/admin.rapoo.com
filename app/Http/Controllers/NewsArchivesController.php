<?php

namespace App\Http\Controllers;

use App\Services\NewsArchivesService;
use App\Http\Requests\NewsArchivesRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;

class NewsArchivesController extends AbstractController
{

    /**
     * 初始化
     *
     * @param  $articleService ArticleService实例
     * @access public
     */
    public function __construct(NewsArchivesRequest $newsArchivesService)
    {
        parent::__construct();
        $this->newsArchivesService = $newsArchivesService;
    }

    /**
     * 文章列表呈现
     */
    public function index(Search $search)
    {   
        $newsArchives   = $this->newsArchivesService->index($search);
        return View::make('newsarchives.index',compact('newsArchives'));
    }

    /**
     * 编辑文章页面
     *
     * @param int $id 文章id
     */
    public function edit( Data $qiniu, $id)
    {
        $newType = $this->newsArchivesService->getModel()->find($id);
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
        if(!$this->newsArchivesService->processData($request, $id)){
            return redirect('newtype/edit/'.$id)->withErrors($this->newsArchivesService->getErrorMessage());
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
        if($articles = $this->newsArchivesService->processDeleteData(Input::get('id'))){
            return redirect('newtype/index');
        } 
    }
}