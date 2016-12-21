<?php

namespace App\Services;

use App\Models\ProductDocument;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;
use zgldh\QiniuStorage\QiniuStorage;

class ProductDocumentService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $productDocumentModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct(ProductDocument $productDocument)
    {
        parent::__construct();
        $this->productDocumentModel = $productDocument;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->productDocumentModel;
    }

    /**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->productDocumentModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }

    /**
     * 上传图片
     * 
     * @var object
     */
    public function uploadFiles($formname = 'filename')
    {
        $disk = QiniuStorage::disk('qiniu');
        if ($file = \Request::file($formname)) {
            $fileName        = $file->getClientOriginalName();
            $extension       = $file->getClientOriginalExtension();
            $qiniuName       = $fileName;
            $disk->put($qiniuName, file_get_contents($_FILES[$formname]['tmp_name']));
            return $qiniuName;
        } else {
            $this->setErrorMsg('上传文件失败，请重新上传');
            return false;
        } 
    }
    
}