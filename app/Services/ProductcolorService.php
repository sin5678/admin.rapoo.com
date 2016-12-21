<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Permission;
use App\Services\BaseService;
use DB,Validator,Hash;
use App\Models\ProductColor;

class ProductcolorService extends BaseService
{
    
    /**
     * 产品颜色表
     *
     * @param $kw keyword for searching.
     */
    public function getList($kw )
    {

       if($kw){
           return DB::table('productcolor as pc')
           ->select('pc.ProductCode','pc.CID','bc.ColorName','pt.Language','c.CountryName','pc.ColorID')
           ->leftJoin('basecolor as bc', 'pc.ColorID', '=', 'bc.ColorID')
           ->leftJoin('producttranslate as pt', 'pc.PID', '=', 'pt.PID')
           ->leftJoin('country as c', 'c.EnglishShort', '=', 'pt.Language')
           ->where('pc.ProductCode','like','%'.$kw.'%')
           ->orWhere('bc.ColorName','like','%'.$kw.'%')
           ->orWhere('pt.Language','like','%'.$kw.'%')
           ->orWhere('c.CountryName','like','%'.$kw.'%')
           ->orderBy('pc.CID')
           ->paginate(20);
       } else {
           // return DB::table('productcolor as pc')
           // ->select('pc.ProductCode','pc.CID','bc.ColorName','pt.Language','c.CountryName')
           // ->leftJoin('basecolor as bc', 'pc.ColorID', '=', 'bc.ColorID')
           // ->leftJoin('producttranslate as pt', 'pc.PID', '=', 'pt.PID')
           // ->leftJoin('country as c', 'c.EnglishShort', '=', 'pt.Language')
           // ->orderBy('pc.CID')
           // ->paginate(8);
           return DB::table('productcolor as pc')
           ->select('pc.ProductCode','pc.CID','pc.ColorID','pt.Language')
           ->join('producttranslate as pt', 'pc.PID', '=', 'pt.PID')
           ->orderBy('pc.CID')
           ->paginate(20);
       }


    }
    
    /**
     * 获取一条
     *
     * @param (str) $id = CountryName
     */
    public function getItem($id)
    {
        return DB::table('productcolor as pc')
        ->select('pc.ProductCode','pc.CID','bc.ColorName')
        ->join('basecolor as bc', 'pc.ColorID', '=', 'bc.ColorID')
        ->where('CID', '=', $id)->first();
    }
    
    /**
     * 增加一条
     *
     * @param (object) $request
     */
    public function createItem($request)
    { 
        $data=array();
        if( $request->ProductCode == '--' || !$request->countries ){ return false; }
       // $ProductCode = explode(',',$request->ProductCode);
        $countries   = $request->countries;
        $colors      = $request->colors?$request->colors:'';
            if(is_array( $colors )){
                for($k=0;$k<count($colors );$k++){
                     for($i=0;$i<count($countries );$i++){
                         $countries2 = explode(',', $countries[$i]);
                         $data[$i]['CID']      = $colors[$k];
                         $data[$i]['Language'] = $countries2[1];
                     }
                     DB::table('colordistribute')->insert($data);
                }
            }
        
        return true;
    }
    
    /**
     * 执行编辑地址
     *
     * @param (arr) $request->id = CountryName
     */
    public function store($request)
    {
    
        $id = $request->id;
         
        $data=array();
        $data['CountryName']      = $request->CountryName;
        $data['AreaID']           = $request->AreaID;
        $data['EnglishName']      = $request->EnglishName;
        $data['EnglishShort']     = $request->EnglishShort;
        $data['Facebook']         = $request->Facebook;
        $data['YouTube']          = $request->YouTube;
        $data['Twitter']          = $request->Twitter;
        $data['Remark']           = $request->Remark;
        $this->areamappingadd($id,$request->areamaping);
        return DB::table('country')->where('CID', $id)->update($data);
    }
    
    /**
     * 执行删除一条
     *
     * @param PID $id
     */
    public function delete($id)
    {
       return DB::table('colordistribute')->where('CID', '=', $id )->delete();
        //return DB::table('productcolor')->where('CID', '=', $id )->delete();
    }
    
    /**
     * 获得国家地区
     *
     */
    public function getAreas()
    {
        return DB::table('countryarea')->get();
    }
    
    /**
     * 获得国家区域对应
     * param $countryID
     */
    public function getAreamapping($countryID)
    {
        $re= DB::table('countrymappingarea')->select('AreaID')->where('CountryID','=',$countryID)->get();
        $string='';
        for($i=0;$i<count($re);$i++){
            $string.=$re[$i]->AreaID.',';
        }
        return explode(',', trim($string,','));
    }
    
    /**
     * 获取国家
     *
     * @param $request = id
     */
    public function getCountry()
    {
        return DB::table('country')->get();
    }
    
    /**
     * 获取国家地区分布
     *
     * @param $request = id
     */
    public function getCountryAreaMapping()
    {
        $tmp = array();
        $re =DB::table('countrymappingarea')->get();
        for($i=0;$i<count($re);$i++){
            $tmp[$re[$i]->AreaID][] = $re[$i]->CountryID;
        }
        return $tmp;
    }
    
    /**
     * 获取产品型号
     *
     * @param $request = id
     */
    public function getProductModels()
    {
        return DB::table('productnew')->get();
    }
    
    /**
     * 获取颜色list
     *
     * @param $request = id
     */
    public function getColor( $request )
    {
        if($request->pid){
            return DB::table('basecolor')->where('PID','=',$request->pid)->get();
        }else {
            return DB::table('basecolor')->get();
        }
        
    }
    
    /**
     * 获取颜色list
     *
     * @param $request = id
     */
    public function getModelColors($request )
    {
        return DB::table('productcolor as pc')
        ->select('pc.CID','bc.ColorID','bc.ColorName','bc.ColorValue')
        ->join('basecolor as bc', 'pc.ColorID', '=', 'bc.ColorID')
        ->where('pc.PID','=',$request)
        ->get();
    }
    
    
    
}//