<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Permission;
use App\Services\BaseService;
use DB,Validator,Hash;

class LangsService extends BaseService
{
    
    /**
     * 国家信息表
     *
     * @param $kw keyword for searching.
     */
    public function getList($kw )
    {
        if(empty($kw )){
            return DB::table('country')->select('*')->paginate(20);
        } else {
            return DB::table('country')
            ->select('*')
            ->where('CountryName','like','%'.$kw.'%')
            ->orWhere('EnglishName','like','%'.$kw.'%')
            ->orWhere('EnglishShort','like','%'.$kw.'%')
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
        return DB::table('country')->where('CountryID', '=', $id)->first();
    }
    
    /**
     * 增加一条语言
     *
     * @param (object) $request
     */
    public function createItem($request)
    { 
        $data=array();
        $data['CountryName']      = $request->CountryName;
        $data['AreaID']           = $request->AreaID;
        $data['EnglishName']      = $request->EnglishName;
        $data['EnglishShort']     = $request->EnglishShort;
        $data['Facebook']         = $request->Facebook;
        $data['YouTube']          = $request->YouTube;
        $data['Twitter']          = $request->Twitter;
        $data['Remark']           = $request->Remark;
        $cid = DB::table('country')->insertGetId($data);
        $this->areamappingadd($cid,$request->areamaping);
        return $cid;
    }
    
    /**
     * 添加到国家对地区
     * param array $areaIDs;
     */
    public function areamappingadd($countyId,$areaIDs)
    {
        DB::table('countrymappingarea')->where('CountryID', '=', $countyId )->delete();
        $data=array();
        $data['CountryID']      = $countyId;
        for($i=0;$i<count($areaIDs );$i++){
            $data['AreaID']           = $areaIDs[$i];
            DB::table('countrymappingarea')->insertGetId($data);
        }
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
        return DB::table('country')->where('CountryID', $id)->update($data);
    }
    
    /**
     * 执行删除一条地址
     *
     * @param (arr) $data
     */
    public function delete($request)
    {
        return DB::table('country')->where('CountryID', '=', $request )->delete();
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
     * 获得所有国家地区
     *
     */
    public function getcountry()
    {
        return DB::table('country')->get();
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
    
}//