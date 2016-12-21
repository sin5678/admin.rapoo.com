<?php

namespace App\Http\Controllers;

use App\Services\ProductcolorService;
use App\Services\CommonService;
use App\Models\Role;
use App\Models\BaseColor;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\ProductcolorRequest;
use App\Models\Permission;
use Entrust;
use App\Http\Controllers\AbstractController as AbstractController;

class ProductcolorController extends AbstractController
{

    public function __construct(ProductcolorService $ProductcolorService )
    {
        parent::__construct();
        $this->ProductcolorService = $ProductcolorService;
        
    }
    
    /**
     * 列出主页
     *
     * @param 
     */
    public function index( Request $request  )
    {
        $dataList = $this->ProductcolorService->getList($request->keyword );
        $colorResult = BaseColor::all();
        foreach($colorResult as $key => $value){
            $baseColor[$value->ColorID] = $value;
        }
        $countryResult = Country::all();
        foreach($countryResult as $key => $value){
            $country[$value->EnglishShort] = $value;
        }
        return view('productcolor.list',['keyword'=>$request->keyword ])->with('dataList', $dataList)->with('baseColor',$baseColor)->with('country', $country);
    }

    /**
     * 添加页面
     *
     * @param
     */
    public function add(Request $request)
    {
        $areas          = $this->ProductcolorService->getAreas();
        $country_list   = $this->ProductcolorService->getCountry(); 
        $countryAreaMapping   = $this->ProductcolorService->getCountryAreaMapping();
        $product_models = $this->ProductcolorService->getProductModels();
        $colorList      = $this->ProductcolorService->getColor($request);
        return view('productcolor.add',[
            'colorList'=>$colorList,
            'areas'=>$areas,
            'country_list'=>$country_list,
            'product_models'=>$product_models,
            'countryAreaMapping'=>$countryAreaMapping,
            
        ]);
    }

    /**
     * 执行添加
     *
     * @param
     */
    public function save(Request $request)
    {
        if($this->ProductcolorService->createItem($request)){
            return redirect('/productcolor')->withErrors('项目创建完成');
        } else{
            return redirect('/productcolor/add')->withErrors('项目填写不完整');
        }
    }
    
    /**
     * 编辑页面
     *
     * @param
     */
    public function edit( Request $request )
    {
        return false;
        $dataInfo       = $this->ProductcolorService->getItem($request->id);
        $areas          = $this->ProductcolorService->getAreas();
        $country_list   = $this->ProductcolorService->getCountry();
        $countryAreaMapping   = $this->ProductcolorService->getCountryAreaMapping();
        $product_models = $this->ProductcolorService->getProductModels();
        $colorList      = $this->ProductcolorService->getColor($request);
        return view('productcolor.edit')->with([
            'dataInfo' => $dataInfo,
            'colorList'=>$colorList,
            'areas'=>$areas,
            'country_list'=>$country_list,
            'product_models'=>$product_models,
            'countryAreaMapping'=>$countryAreaMapping,
            'id'=>$request->id,
        ]);
    }
    
    /**
     * 编辑页面返回型号颜色
     *
     * @param
     */
    public function getModelColors( Request $request )
    {
        $str='';
        $result = $this->ProductcolorService->getModelColors($request->id);
        for($i=0;$i<count($result);$i++){
            $str.='<div style="width:130px;height:30px;border:1px solid silver;margin:1px;float:left;">
					 <label>
						 <input type="checkbox" name="colors[]" value="'.$result[$i]->CID.'" style="width:30px;" >
						 '.$result[$i]->ColorName.'
						 <div style="border: 1px solid #ccc; background: '.$result[$i]->ColorValue.'; width: 20px;height: 20px;float:right;line-height:20px;margin:4px;"></div>
					 </label>
				</div>';
        }
        return response()->json(array(
	       'colors' => $str,
        ));
  }
    

    /**
     * 编辑保存
     *
     * @param
     */
    public function store( LangsRequest $request )
    {
        if ( $this->ProductcolorService->store($request) ) {
            return redirect('/productcolor')->withErrors('修改完成');
        } else {
            return redirect('/productcolor')->withErrors('未修改');
        }
    }


    /**
     * 删除
     *
     * @param $id = CountryName
     */
    public function delete( Request $request )
    {
        $userInfo = $this->ProductcolorService->delete($request->id);
        return redirect('/productcolor')->withErrors('删除完成');
    }

    
}//