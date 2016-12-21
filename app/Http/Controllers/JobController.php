<?php

namespace App\Http\Controllers;

use App\Services\JobService;
use App\Http\Requests\JobRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;

class JobController extends AbstractController
{
    /**
     * 初始化
     *
     * @param  $articleService ArticleService实例
     * @access public
     */
    public function __construct(JobService $jobService)
    {
        parent::__construct();
        $this->jobService = $jobService;
    }

    /**
     * 文章列表呈现
     */
    public function index(Search $search)
    {   
        $jobs  = $this->jobService->index($search);
        return View::make('job.index',compact('jobs'));
    }

    /**
     * 添加文章页面
     */
    public function create()
    {
        return View::make('job.create');
    }

    /**
     * 保存文章
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     */
    public function store(Data $qiniu, JobRequest $request)
    {   
        $request = $request->all();
        if(!$this->jobService->processData($request)){
            return redirect('job/create')->withErrors($this->articleService->getErrorMessage());
        }
        return redirect('job/index');
    }

    /**
     * 编辑文章页面
     *
     * @param int $id 文章id
     */
    public function edit( Data $qiniu, $id)
    {
        $job = $this->jobService->getModel()->find($id);
        return View::make('job.edit', compact('job'));
    }

    /**
     * 修改文章保存
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * @param int $id 文章id
     */
    public function update(Data $qiniu, JobRequest $request, $id)
    {   
        $request = $request->all();
        if(!$this->jobService->processData($request, $id)){
            return redirect('job/edit/'.$id)->withErrors($this->jobService->getErrorMessage());
        }
        return redirect('job/index');
    }

    /**
     * 删除
     *
     * @param void
     */
    public function delete(Data $qiniu)
    {   
        if($articles = $this->jobService->processDeleteData(Input::get('id'))){
            return redirect('job/index');
        } 
    }
}