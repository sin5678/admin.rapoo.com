<?php
namespace App\Services\Language;

use App\Models\Lang;
use View,Route,Entrust,DB,Cache;

class Language
{   
    /**
     * 存储语言数组
     * @var array
     */
    public $langs = [];

    /**
     * 语言模型
     * 
     * @var object
     */
    private $langModel;
    
    
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        $this->langModel = new Lang;
        $langs = $this->getLangPermissions('ob');
        $this->getLangsDisplay($langs);
        View::share('langs', $langs);
    }

    /**
     * 获得语言权限
     *
     * @param string str ,string ob,default array
     * @return array(lang) / string(lang) / object(all)
     */
    public function getLangPermissions( $return = '' )
    {   
        if(empty($langs = Cache::get('language_cache_state_1'))){
            $langs = Lang::where([ 'state' => 1 ])->orderBy('level', 'desc')->get();
            Cache::add('language_cache_state_1', $langs, 1440);
        }
        //$langs = Lang::where([ 'state' => 1 ])->orderBy('level', 'desc')->get();
        $permissions = array();
        foreach( $langs as $k => $v ){
            if( Entrust::can( 'lang_'.$v->lang ) ){ 
                $permissions[] = ($return == 'ob' ? $v : $v->lang);
            }
        }
        $return == 'str' && ($permissions = implode(',',$permissions));
        return $permissions;
    }

    /**
     * 获取语言显示
     * 
     * @param object $query
     */
    public function getLangsDisplay($langs)
    {
        $display = [];
        foreach($langs as $key => $value){
            $display[$value->lang] = $value->display;
            $this->langs[] = $value->lang;
        }
        View::share('display', $display);
    }
    
}