<?php
namespace App\Models\Observers;

use App\Models\Category;
use App\Services\Language\Language;
use Cache;

class CategoryObservers
{
    /**
     * 缓存名称
     */
    protected $cacheName = 'category_cache_lang';

    /**
     * 缓存时间
     */
    protected $cacheMinutes = 1440;

    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        $this->langService = new Language();
    }

    /**
     * 添加缓存
     */
    public function saved(Category $model)
    {
        $category = Category::whereIn('lang', $this->langService->langs)->get()->toArray();
        Cache::put($this->cacheName, $category, $this->cacheMinutes);
    }

    /**
     * 删除缓存
     */
    public function deleted(Category $model)
    {
        $category = Category::whereIn('lang', $this->langService->langs)->get()->toArray();
        Cache::put($this->cacheName, $category, $this->cacheMinutes);
    }

    /**
     * 更新缓存
     */
    public function updated(Category $model)
    {
        $category = Category::whereIn('lang', $this->langService->langs)->get()->toArray();
        Cache::put($this->cacheName, $category, $this->cacheMinutes);
    }
}