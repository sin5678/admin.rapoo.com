<?php

namespace App\Services;

use App\Models\Article;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;

class ArticleService extends BaseService
{
    /**
     * 
     * @var object
     */
    private $articleModel;
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct(Article $article)
    {
        parent::__construct();
        $this->articleModel = $article;
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->articleModel;
    }

	/**
     * 文章列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
	public function index($search, $pageSize=10)
	{   
        $builder = $this->articleModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
	}

    /**
     * 批量转移到新的分类
     *
     * @param  int $newCatId 
     * @param  array $id 
     * @return bool
     */
    public function batchMove($newCatId, array $id)
    {   
        if(!$id) return $this->setErrorMsg('没有选择文章');
        return $this->articleModel->editContentByIdArr(['cat_id' => $newCatId], $id);
    }
}