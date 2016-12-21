<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Permission;
use App\Services\BaseService;
use DB,Validator,Hash;

class CountryareaService extends BaseService
{
    
    /**
     * 区域数据表
     *
     * @param $kw keyword for searching.
     */
    public function getList($kw )
    {
        if(empty($kw )){
            return DB::table('countryarea')->select('*')->paginate(20);
        } else {
            return DB::table('countryarea')->get();
        }
    }


    /**
     * 获取所有国家
     *
     * @param $kw keyword for searching.
     */
    public function getCountry()
    {
        return DB::table('country')->get();
    }

    /**
     * 获取所有地区
     *
     * @param $kw keyword for searching.
     */
    public function getArea()
    {
        return DB::table('countryarea')->get();
    }



    /**
     * 获取所有国家和地域的关系
     *
     * @param $kw keyword for searching.
     */
    public function getMap()
    {
        return DB::table('countrymappingarea')->get();

    }

    /**
     * 获取地域所对应的所有国家
     *
     * @param $kw keyword for searching.
     */
    public function getAreaCountrys()
    {
        $countryareas = $this->getMap();
        $arr = [];
        foreach($countryareas as $key => $value){
            $arr[$value->AreaID][] = $value->CountryID;
        }
        return $arr;
    }

    public function getCountryAreas($countryId)
    {
        return DB::table('countrymappingarea')->where('CountryID','=',$countryId)->get();
    }





    /**
     * 获取一条
     *
     * @param (str) $id = CountryName
     */
    public function getItem($id)
    {
        return DB::table('countryarea')->where('AreaID', '=', $id)->first();
    }
    
    /**
     * 增加一条
     *
     * @param (object) $request
     */
    public function createItem($request)
    {
        
        $data=array();
        $data['AreaName']      = $request->AreaName;
        $data['AreaDesc']      = $request->AreaDesc;
        $areaid = DB::table('countryarea')->insertGetId($data);
        $this->areamappingadd($areaid,$request->countries);
        return $areaid;
    }
    
    /**
     * 执行编辑
     *
     * @param (arr) $request->id = CountryName
     */
    public function store($request)
    {
        $id = $request->id;
        $data=array();
        $data['AreaName']      = $request->AreaName;
        $data['AreaDesc']      = $request->AreaDesc;
        $this->areamappingadd($request->id,$request->countries);
        return DB::table('countryarea')->where('AreaID', $id)->update($data);
    }
    
    /**
     * 执行删除一条
     *
     * @param $request = id
     */
    public function delete($request)
    {
        DB::table('countryarea')->where('AreaID', '=', $request )->delete();
        return DB::table('countrymappingarea')->where('AreaID', '=', $request )->delete();
    }
    
    /**
     * 获取国家
     *
     * @param $request = id
     */
    // public function getCountry()
    // {
    //     return DB::table('country')->get();
    // }
    
    /**
     * 获取已经分配的国家
     *
     * @param $aid 地区id 
     * return array 国家ids
     */
    public function getCountryAssigned($aid)
    {
        $data = array();
        $list = DB::table('countrymappingarea')->select('CountryID')->where('AreaID','=',$aid)->get();
        for($i=0;$i<count($list);$i++){
            $data[$i] = $list[$i]->CountryID;
        }
        return $data;
    }
    
    /**
     * 添加到地区对多国家
     * param array $areaIDs;
     */
    public function areamappingadd($AreaID,$countryIDs)
    {
        DB::table('countrymappingarea')->where('AreaID', '=', $AreaID )->delete();
        $data=array();
        $data['AreaID']      = $AreaID;
        for($i=0;$i<count($countryIDs );$i++){
            $data['CountryID']           = $countryIDs[$i];
            DB::table('countrymappingarea')->insertGetId($data);
        }
    }
    
}//