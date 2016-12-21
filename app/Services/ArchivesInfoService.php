<?php

namespace App\Services;

use App\Models\ArchivesInfo;
use App\Http\Requests;
use App\Http\Requests\ArchivesInfoRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class ArchivesInfoService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $archivesInfoModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct(ArchivesInfo $archivesInfo)
    {
        parent::__construct();
        $this->archivesInfoModel = $archivesInfo;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->archivesInfoModel;
    }

    /**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->archivesInfoModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }
    
}