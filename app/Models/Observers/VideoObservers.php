<?php
namespace App\Models\Observers;

use App\Models\Video;
use Cache;

class VideoObservers
{
	/**
     * 缓存名称
     */
	protected $cacheName = 'video_cache_';

	/**
     * 缓存时间
     */
	protected $cacheMinutes = 1440;

	/**
     * 添加缓存
     */
    public function saved(Video $model)
    {

    }

    /**
     * 删除缓存
     */
    public function deleted(Video $model)
    {
       	if(!empty(Cache::get($key = $this->cacheName . $model->id))){
            Cache::forget($key);
        }
    }

    /**
     * 更新缓存
     */
    public function updated(Video $model)
    {
    	Cache::put($this->cacheName . $model->id, $model, $this->cacheMinutes);
    }
}