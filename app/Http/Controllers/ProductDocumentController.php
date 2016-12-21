<?php

namespace App\Http\Controllers;

use App\Services\CountryareaService;
use App\Services\ProductDocumentService;
use App\Services\DocumentTypeService;
use App\Models\Product;
use App\Http\Requests\ProductDocumentRequest;
use Input,Redirect,View,Request,Route;
use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\Search\Search;
use App\Services\Qiniu\Data;

class ProductDocumentController extends AbstractController
{

    /**
     * 初始化
     *
     * @param  $articleService ArticleService实例
     * @access public
     */
    public function __construct(ProductDocumentService $productDocumentService)
    {
        parent::__construct();
        $this->productDocumentService = $productDocumentService;
        $this->documentTypeService = new DocumentTypeService;
        $this->countryareaService = new CountryareaService;
    }

    /**
     * 文章列表呈现
     */
    public function index(Search $search)
    {   
        $products = Product::select('PID','ProductCode','ProductName')->get();
        foreach($products as $key => $value){
            $productResults[$value->PID] = $value;
        }
        $productDocuments   = $this->productDocumentService->index($search);
        return View::make('productdocument.index',compact('productDocuments','productResults'));
    }

    /**
     * 添加文章页面
     */
    public function create()
    {
        $products = Product::select('PID','ProductCode','ProductName')->get();
        $areas    = $this->countryareaService->getArea();
        $areaCountrys = $this->countryareaService->getAreaCountrys();
        $countrys = $this->countryareaService->getCountry();
        $documentTypes = $this->documentTypeService->getDocumentType();
        return View::make('productdocument.create',compact('documentTypes','countrys','areas','areaCountrys','products'));
    }

    /**
     * 保存文章
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * 
     */
    public function store(Data $qiniu, ProductDocumentRequest $request)
    {   
        $request = $request->all();
        if($file = $this->productDocumentService->uploadFiles('DocumentAttachment')) $request['DocumentAttachment'] = $file;
        if($request['txtCountryName']) $request['Language'] = implode(",",$request['txtCountryName']);
        if($request['PIDs']) $request['PIDs'] = implode(",",$request['PIDs']);
        if(!$this->productDocumentService->processData($request)){
            return redirect('productdocument/create')->withErrors($this->productDocumentService->getErrorMessage());
        }
        return redirect('productdocument/index');
    }

    /**
     * 编辑文章页面
     *
     * @param int $id 文章id
     */
    public function edit( Data $qiniu, $id)
    {
        $products = Product::select('PID','ProductCode','ProductName')->get();
        $productDocument = $this->productDocumentService->getModel()->find($id);
        $productDocument['Language'] = explode(",",$productDocument['Language']);
        $productDocument['PIDs'] = explode(",",$productDocument['PIDs']);
        $areas    = $this->countryareaService->getArea();
        $areaCountrys = $this->countryareaService->getAreaCountrys();
        $countrys = $this->countryareaService->getCountry();
        $documentTypes = $this->documentTypeService->getDocumentType();
        return View::make('productdocument.edit', compact('productDocument','documentTypes','countrys','areas','areaCountrys','products'));
    }

    /**
     * 修改文章保存
     *
     * @param ArticleRequest $articleRequest ArticleRequest请求实例
     * @param int $id 文章id
     */
    public function update(Data $qiniu, ProductDocumentRequest $request, $id)
    {   
        $request = $request->all();
        if($file = $this->productDocumentService->uploadFiles('DocumentAttachment')) $request['DocumentAttachment'] = $file;
        if($request['txtCountryName']) $request['Language'] = implode(",",$request['txtCountryName']);
        if($request['PIDs']) $request['PIDs'] = implode(",",$request['PIDs']);
        if(!$this->productDocumentService->processData($request, $id)){
            return redirect('productdocument/edit/'.$id)->withErrors($this->productDocumentService->getErrorMessage());
        }
        return redirect('productdocument/index');
    }

    /**
     * 删除
     *
     * @param void
     */
    public function delete(Data $qiniu)
    {   
        if($this->productDocumentService->processDeleteData(Input::get('id'))){
            return redirect('productdocument/index');
        } 
    }
}