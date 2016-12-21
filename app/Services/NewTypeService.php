<?php

namespace App\Services;

use App\Models\NewType;
use App\Http\Requests;
use App\Http\Requests\NewTypeRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class NewTypeService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $newTypeModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->newTypeModel = new NewType;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->newTypeModel;
    }

    /**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->newTypeModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }

    public function getNewType()
    {
        return $this->newTypeModel->select('NewTypeID','NewTypeName')->get();
    }
    
}