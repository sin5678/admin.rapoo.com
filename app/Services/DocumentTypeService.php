<?php

namespace App\Services;

use App\Models\DocumentType;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class DocumentTypeService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $documentTypeModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->documentTypeModel = new DocumentType;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->documentTypeModel;
    }

    /**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->documentTypeModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }

    public function getDocumentType()
    {
        return $this->documentTypeModel->select('DocumentTypeID','DocumentTypeName')->get();
    }
    
}