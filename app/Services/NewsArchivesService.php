<?php

namespace App\Services;

use App\Models\NewsArchives;
use App\Http\Requests;
use App\Http\Requests\NewsArchivesRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class NewsArchivesService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $newsArchivesModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->newsArchivesModel = new NewsArchives();
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
        $builder = $this->newsArchivesModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }

    public function getNewsArchives($archivesID)
    {
        return $this->newsArchivesModel->where('ArchivesID', '=', $archivesID)->leftJoin('news', 'news.NewID', '=', 'newsarchives.NewID')->paginate(10);
    }
    
}