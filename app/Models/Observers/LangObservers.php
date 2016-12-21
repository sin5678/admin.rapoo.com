<?php
namespace App\Models\Observers;

use App\Models\Lang;
use App\Models\Category;
use Cache;

class LangObservers
{
	/**
     * 缓存名称
     */
	protected $cacheName = 'language_cache_state_1';

	/**
     * 缓存时间
     */
	protected $cacheMinutes = 1440;

	/**
     * 添加缓存
     */
    public function saved(Lang $model)
    {
        $langs = Lang::where([ 'state' => 1 ])->orderBy('level', 'desc')->get();
        Cache::put($this->cacheName, $langs, $this->cacheMinutes);
    }

    /**
     * 删除缓存
     */
    public function deleted(Lang $model)
    {
        $langs = Lang::where([ 'state' => 1 ])->orderBy('level', 'desc')->get();
       	Cache::put($this->cacheName, $langs, $this->cacheMinutes);
    }

    /**
     * 更新缓存
     */
    public function updated(Lang $model)
    {
        $langs = Lang::where([ 'state' => 1 ])->orderBy('level', 'desc')->get();
    	Cache::put($this->cacheName, $langs, $this->cacheMinutes);
    }
}