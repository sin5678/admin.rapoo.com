<?php

namespace App\Services;

use App\Models\SiteSpellDetail;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class SiteSpellDetailService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $siteSpellDetailModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->siteSpellDetailModel = new SiteSpellDetail;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->siteSpellDetailModel;
    }

    /**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->siteSpellDetailModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }
    
}