<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Services\NewTypeService;
use App\Services\CountryareaService;
use App\Models\InfoDistribute;
use App\Http\Requests\ArticleRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;

class ArticlesController extends AbstractController
{
    /**
     * 分类模型
     * 
     * @var object
     */
    private $categoryService;

    /**
     * 初始化
     *
     * @param  $articleService ArticleService实例
     * @access public
     */
    public function __construct(ArticleService $articleService)
    {
        parent::__construct();
        $this->articleService = $articleService;
        $this->newTypeService = new NewTypeService;
        $this->countryareaService = new CountryareaService;
    }

    /**
     * 文章列表呈现
     */
    public function index(Search $search)
    {   
        $articles   = $this->articleService->index($search);
        return View::make('article.index',compact('articles'));
    }

    /**
     * 添加文章页面
     */
    public function create()
    {
        $areas    = $this->countryareaService->getArea();
        $areaCountrys = $this->countryareaService->getAreaCountrys();
        $countrys = $this->countryareaService->getCountry();
        $newTypes = $this->newTypeService->getNewType();
        return View::make('article.create',compact('newTypes','countrys','areas','areaCountrys'));
    }

    /**
     * 保存文章
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     */
    public function store(Data $qiniu, ArticleRequest $request)
    {   
        $request = $request->all();
        if($file = $qiniu->upload('ProfileImg')) $request['ProfileImg'] = $file['filePath'];
        if(!$this->articleService->processData($request)){
            return redirect('articles/create')->withErrors($this->articleService->getErrorMessage());
        }
        return redirect('articles/index');
    }

    /**
     * 编辑文章页面
     *
     * @param int $id 文章id
     */
    public function edit( Data $qiniu, $id)
    {
        $areas    = $this->countryareaService->getArea();
        $areaCountrys = $this->countryareaService->getAreaCountrys();
        $countrys = $this->countryareaService->getCountry();
        $infoDistributes = InfoDistribute::select('CountryID')->where('InfoID','=',$id)->get()->toArray();
        $infoDistributes = array_column($infoDistributes,'CountryID');

        $article = $qiniu->prepareObjectImgData($this->articleService->getModel()->find($id), 'ProfileImg');
        return View::make('article.edit', compact('article','countrys','areas','areaCountrys','infoDistributes'));
    }

    /**
     * 修改文章保存
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * @param int $id 文章id
     */
    public function update(Data $qiniu, ArticleRequest $request, $id)
    {   
        $request = $request->all();
        if($file = $qiniu->upload('ProfileImg')) $request['ProfileImg'] = $file['filePath'];
        if(!$oldArticle = $this->articleService->processData($request, $id)){
            return redirect('articles/edit/'.$id)->withErrors($this->articleService->getErrorMessage());
        }
        //$this->setActionLog($oldArticle);
        return redirect('articles/index');
    }

    /**
     * 删除
     *
     * @param void
     */
    public function delete(Data $qiniu)
    {   
        if($articles = $this->articleService->processDeleteData(Input::get('id'))){
            $qiniu->prepareDeleteImgData($articles);
            //$this->setActionLog(['articles' => $articles]);
            return redirect('articles/index');
        } 
    }

    public function publish()
    {

    }

    /**
     * 上传
     */
    public function upload(Data $qiniu)
    {
        if($file = $qiniu->upload($name = 'upload', $pre = 'img-', $allowed_extensions=["png", "jpg", "gif"])){
            //$previewname = $qiniu->getDisk()->downloadUrl($file['filePath']);
            $previewname = env('QINIU_DOMAINS_CUSTOM') . $file['filePath'];
            $callback = $_REQUEST["CKEditorFuncNum"]; 
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($callback,'".$previewname."','');</script>";  
        } else {
            echo "<font color=\"red\"size=\"2\">*文件格式不正确（必须为.jpg/.gif/.bmp/.png文件）</font>";  
        }
    }


}