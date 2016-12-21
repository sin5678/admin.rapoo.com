<?php

namespace App\Http\Controllers;

use App\Models\SiteSpell;
use App\Models\SiteSpellDetail;
use App\Services\SiteSpellService;
use App\Services\CountryareaService;
use App\Http\Requests\SiteSpellRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;

class SiteSpellController extends AbstractController
{

    /**
     * 初始化
     *
     * @access public
     */
    public function __construct(SiteSpellService $siteSpellService)
    {
        parent::__construct();
        $this->siteSpellService = $siteSpellService;
        $this->countryareaService = new CountryareaService;
    }

    /**
     * 列表呈现
     */
    public function index(Search $search)
    {   
        $arr = $this->countryareaService->getCountry();
        foreach($arr as $key => $value){
            $countrys[$value->EnglishShort] = $value;
        }
        $siteSpells = $this->siteSpellService->index($search);
        return View::make('sitespell.index',compact('siteSpells','countrys'));
    }

    /**
     * 添加页面
     */
    public function create()
    {
        $countrys = $this->countryareaService->getCountry();
        return View::make('sitespell.create',compact('countrys'));
    }

    /**
     * 保存
     */
    public function store(Data $qiniu, SiteSpellRequest $request)
    {   
        $request = $request->all();
        if($file = $qiniu->upload('ImgUrl')) $request['ImgUrl'] = $file['filePath'];
        if(!$this->siteSpellService->processData($request)){
            return redirect('sitespell/create')->withErrors($this->siteSpellService->getErrorMessage());
        }
        return redirect('sitespell/index');
    }

    /**
     * 编辑
     */
    public function edit( Data $qiniu, $id)
    {
        $countrys = $this->countryareaService->getCountry();
        $siteSpell = $this->siteSpellService->getModel()->find($id);
        $siteSpellDetail = SiteSpellDetail::where('SiteID',$id)->first();
        return View::make('sitespell.edit', compact('siteSpell','countrys','siteSpellDetail'));
    }

    /**
     * 修改
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * @param int $id 文章id
     */
    public function update(Data $qiniu, SiteSpellRequest $request, $id)
    {   
        $request = $request->all();
        if($file = $qiniu->upload('ImgUrl')) $request['ImgUrl'] = $file['filePath'];
        SiteSpellDetail::where('SiteID',$id)->update(['Language' => $request['Language']]);
        if(!$this->siteSpellService->processData($request, $id)){
            return redirect('sitespell/edit/'.$id)->withErrors($this->siteSpellService->getErrorMessage());
        }
        return redirect('sitespell/index');
    }

    /**
     * 删除
     *
     * @param void
     */
    public function delete(Data $qiniu)
    {   
        if($articles = $this->siteSpellService->processDeleteData(Input::get('id'))){
            return redirect('sitespell/index');
        } 
    }
}