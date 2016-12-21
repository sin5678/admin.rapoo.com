<?php

namespace App\Http\Controllers;

use App\Services\ArchivesInfoService;
use App\Services\NewsArchivesService;
use App\Http\Requests\ArchivesInfoRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;

class ArchivesInfoController extends AbstractController
{

    /**
     * 初始化
     *
     * @param  $articleService ArticleService实例
     * @access public
     */
    public function __construct(ArchivesInfoService $archivesInfoService)
    {
        parent::__construct();
        $this->archivesInfoService = $archivesInfoService;
        $this->newsArchivesService = new NewsArchivesService;
    }

    /**
     * 文章列表呈现
     */
    public function index(Search $search)
    {   
        $archivesInfos = $this->archivesInfoService->index($search);
        return View::make('archivesinfo.index',compact('archivesInfos'));
    }

    /**
     * 添加文章页面
     */
    public function create()
    {
        return View::make('archivesinfo.create');
    }

    /**
     * 保存文章
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     */
    public function store(Data $qiniu, ArchivesInfoRequest $request)
    {   
        $request = $request->all();
        if(!$this->archivesInfoService->processData($request)){
            return redirect('archivesinfo/create')->withErrors($this->articleService->getErrorMessage());
        }
        return redirect('archivesinfo/index');
    }

    /**
     * 编辑文章页面
     *
     * @param int $id 文章id
     */
    public function edit( Data $qiniu, $id)
    {
        $archivesInfo = $this->archivesInfoService->getModel()->find($id);
        $newsArchives = $this->newsArchivesService->getNewsArchives($id);
        return View::make('archivesinfo.edit', compact('archivesInfo','newsArchives'));
    }

    /**
     * 修改文章保存
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * @param int $id 文章id
     */
    public function update(Data $qiniu, ArchivesInfoRequest $request, $id)
    {   
        $request = $request->all();
        if(!$this->archivesInfoService->processData($request, $id)){
            return redirect('archivesinfo/edit/'.$id)->withErrors($this->archivesInfoService->getErrorMessage());
        }
        return redirect('archivesinfo/index');
    }

    /**
     * 删除
     *
     * @param void
     */
    public function delete(Data $qiniu)
    {   
        if($this->archivesInfoService->processDeleteData(Input::get('id'))){
            return redirect('archivesinfo/index');
        } 
    }
}