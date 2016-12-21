<?php

namespace App\Services;

use App\Models\Job;
use App\Http\Requests;
use App\Http\Requests\JobRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class JobService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $jobModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->jobModel = new Job;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->jobModel;
    }

    /**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->jobModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }
    
}