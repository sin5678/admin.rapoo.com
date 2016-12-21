<?php

namespace App\Http\Controllers;

use App\Services\CountryareaService;
use App\Services\CommonService;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\CountryareaRequest;
use App\Models\Permission;
use Entrust;
use App\Http\Controllers\AbstractController as AbstractController;

class CountryareaController extends AbstractController
{

    public function __construct(CountryareaService $CountryareaService )
    {
        parent::__construct();
        $this->CountryareaService = $CountryareaService;
        
    }
    
    /**
     * 列出主页
     *
     * @param 
     */
    public function index( Request $request  )
    {
        $dataList = $this->CountryareaService->getList($request->keyword );
        return view('countryarea.list',['keyword'=>$request->keyword])->with('dataList', $dataList);
    }

    /**
     *  显示地域和国家的关系
     *
     */
    public function selectAreaCounty()
    {
        $countryList = $this->CountryareaService->getCountry();
        $areaList  = $this->CountryareaService->getArea();
        $map    =    $this ->CountryareaService ->getMap();
        $map = json_encode($map);

       return view("countryarea.map")->with(["countryList"=>$countryList,"areaList"=>$areaList,"map"=>$map]);

    }
    /**
     * 添加页面
     *
     * @param
     */
    public function add()
    {
        $country_list = $this->CountryareaService->getCountry();
        return view('countryarea.add',['country_list'=>$country_list]);
    }

    /**
     * 执行添加
     *
     * @param
     */
    public function save(CountryareaRequest $request)
    {
        if($this->CountryareaService->createItem($request)){
            return redirect('/countryarea')->withErrors('项目创建完成');
        }
    }
    
    /**
     * 编辑页面
     *
     * @param
     */
    public function edit( Request $request )
    {
        $country_list = $this->CountryareaService->getCountry();
        $country_assigned = $this->CountryareaService->getCountryAssigned($request->id);
        $dataInfo   = $this->CountryareaService->getItem($request->id);
        return view('countryarea.edit')->with(['dataInfo' => $dataInfo,'country_list'=>$country_list,'country_assigned'=>$country_assigned]);
    }
    

    /**
     * 编辑保存
     *
     * @param
     */
    public function store( CountryareaRequest $request )
    {
        if ( $this->CountryareaService->store($request) ) {
            return redirect('/countryarea')->withErrors('修改完成');
        } else {
            return redirect('/countryarea')->withErrors('未修改');
        }
    }


    /**
     * 删除
     *
     * @param $id = CountryName
     */
    public function delete( Request $request )
    {
        $userInfo = $this->CountryareaService->delete($request->id);
        return redirect('/countryarea')->withErrors('删除完成');
    }
    
    /**
     * 区域信息接口
     * @param
     */
    public function getCountryArea( Request $request  )
    {
        return $this->CountryareaService->getList();
    }

    
}//