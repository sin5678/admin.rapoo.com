<?php

namespace App\Services;

use App\Models\SiteSpell;
use App\Http\Requests;
use App\Http\Requests\SiteSpellRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class SiteSpellService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $sitesPellModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->sitesPellModel = new SiteSpell;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->sitesPellModel;
    }

    /**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->sitesPellModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }
}