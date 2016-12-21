<?php

namespace App\Services;

use App\Models\Supply;
use App\Http\Requests;
use App\Http\Requests\SupplyRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class SupplyService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $supplyModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->supplyModel = new Supply;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->supplyModel;
    }

    /**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->supplyModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }

    
}