<?php

namespace App\Http\Controllers;

use App\Services\LangsService;
use App\Services\CommonService;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\LangsRequest;
use App\Models\Permission;
use Entrust;
use App\Http\Controllers\AbstractController as AbstractController;

class LangsController extends AbstractController
{

    public function __construct(LangsService $langsService )
    {
        parent::__construct();
        $this->LangsService = $langsService;
        
    }
    
    /**
     * 列出主页
     *
     * @param 
     */
    public function index( Request $request  )
    {
        $dataList = $this->LangsService->getList($request->keyword );
        return view('langs.list',['keyword'=>$request->keyword ])->with('dataList', $dataList);
    }

    /**
     * 添加页面
     *
     * @param
     */
    public function add()
    {
        $areas = $this->LangsService->getAreas();
        return view('langs.add',['areas'=>$areas]);
    }

    /**
     * 执行添加
     *
     * @param
     */
    public function save(LangsRequest $request)
    {
        if($this->LangsService->createItem($request)){
            return redirect('/langs')->withErrors('项目创建完成');
        }
    }
    
    /**
     * 编辑页面
     *
     * @param
     */
    public function edit( Request $request )
    {
        $dataInfo       = $this->LangsService->getItem($request->id);
        $areas          = $this->LangsService->getAreas();
        $areamapping    = $this->LangsService->getAreamapping($request->id);
        return view('langs.edit')->with(['dataInfo' => $dataInfo,'areas'=>$areas,'areamapping'=>$areamapping]);
    }
    

    /**
     * 编辑保存
     *
     * @param
     */
    public function store( LangsRequest $request )
    {
        if ( $this->LangsService->store($request) ) {
            return redirect('/langs')->withErrors('修改完成');
        } else {
            return redirect('/langs')->withErrors('未修改');
        }
    }


    /**
     * 删除
     *
     * @param $id = CountryName
     */
    public function delete( Request $request )
    {
        $userInfo = $this->LangsService->delete($request->id);
        return redirect('/langs')->withErrors('删除完成');
    }

    /**
     * 国家信息接口
     * 
     * @param
     */
    public function getCountry( Request $request  )
    {
        return $this->LangsService->getList($request->keyword );
    }
    
}//