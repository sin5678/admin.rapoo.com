<?php
/**
 * Created by PhpStorm.
 * User: zhangxiaoqiu
 * Date: 2015/11/25
 * Time: 16:53
 */

namespace App\Services;
use App\Services\BaseService;

use DB,Validator,Hash;
use App\Models\Product  as Product;
use App\Services\Qiniu\Data  as Data;


class ProductService extends BaseService
{
    public  function getList()
    {
       $result =  DB::table('product')->select("*")->orderby("PID", "DESC")->paginate(10);
        return $result;
    }

    public  function getProduct($pid)
    {
        return Product::find($pid);
    }

    public  function getProductFiles($pid)
    {
        return  DB::table('productcolor')->leftjoin('basecolor', 'basecolor.ColorID','=','productcolor.ColorID')->where('productcolor.PID',$pid)->get();
    }

    public  function  deleteProduct($pids)
    {
        return  DB::table('product')->whereIn('PID',$pids)->delete();
    }

    public  function  deleteProductWithId($pid)
    {
        return  DB::table('product')->where('PID',$pid)->delete();
    }

    public  function  getProductDistribute($pid)
    {
        return  DB::table('infodistribute')->where("InfoID","=",$pid)->where("InfoType","=",1)->get();
    }


    public  function getSearchList($key)
    {
        $result =  DB::table('product')->select("*")->where('ProductName','like',"%$key%")->orWhere('ProductCode', 'like', "%$key%")->orderby("PID", "DESC")->paginate(10);
        return $result;
    }

    /**  修改产品
     * @param $data
     * @param Data $qiniu
     */
    public  function modify($data,Data $qiniu,$pid)
    {
        //如果图片没有修改就还用原来的
        if(empty($_FILES['fileProductImg']['name']))
        {
            $data['fileProductImg']=$data['fileProductImgHidden'];
        }else
        {
            if($file = $qiniu->upload('fileProductImg')) $data['fileProductImg'] = $file['filePath'];
        }

        if(empty($_FILES['fileSpecialtyImg']['name']))
        {
            $data['fileSpecialtyImg']=$data['fileSpecialtyImgHidden'];
        }else
        {
            if($file = $qiniu->upload('fileSpecialtyImg')) $data['fileSpecialtyImg'] = $file['filePath'];
        }
        //print_r($data);exit;
        //规格
        $productStandard=base64_encode(serialize(($data['ProductStandard'])));

        //是否新品
        if(!empty(trim($data['txtProductExpire'])))
        {
            DB::Table("productnew")->where("PID",$pid)->delete();
            DB::Table("productnew")->insert([
                'PID'=>$pid,
                'ProductCode'=>$data['txtProductCode'],
                'ProductExpire'=>$data['txtProductExpire']
            ]);
        }
        else
        {
            DB::Table("productnew")->where("PID",$pid)->delete();
        }
        //卖点
        $maidainfile=[];
        $length = count($data['maidianfilehidden']);

        for($i=0;$i<$length;$i++) {
            if(!empty($_FILES['maidianfile']['tmp_name'][$i]))
            {
                if($file = $qiniu->uploadArrayFormFiles("maidianfile",$i) )    $filepath= $file['filePath'];
                $maidainfile[]=$filepath;

            }else {
                if (empty($data['maidianfilehidden'][$i])) {
                    $maidainfile[]="";
                }
                else
                {
                    $maidainfile[]=$data['maidianfilehidden'][$i];
                }
            }
        }

        $data['maidian']['file'] = $maidainfile;

        $maidainJson= base64_encode(serialize($data['maidian']));

        $keyWord=$this->getProductTypeById($data["hidProductTypeID"]);
        //修改回数据库
        Product::where('PID', $pid)
            ->update([
            "ProductCode"=>$data['txtProductCode'],
            "ProductName"=>$data['txtProductName'],
            "ProductPrice"=>$data["txtProductPrice"],
            "ProductDesc"=>$data["tareaProductDesc"],
            "ProductType"=>$data["hidProductTypeID"],
            "ProductLifeCycle"=>$data["txtProductLifeCycle"],
            "ProductStandard"=>$productStandard,//规格
            "ProductInterface"=>"",
            "ProductNames"=>$data['txtProductTypeName'],
            "ProductShowJSON"=>$maidainJson,
            "ProductImg"=>isset($data['fileProductImg'])?$data['fileProductImg']:'',//图片
            "ProductBigImg"=>isset($data['fileSpecialtyImg'])?$data['fileSpecialtyImg']:'',//图片
            "LinkMode"=>$data['selLinkMode'],
            "MarketTime"=>$data["txtMarketTime"],
            "Remark"=>$data["tareaRemark"],
            "FavorablePrice"=>$data["txtFavorablePrice"],
            "Popular"=>"",
            "OrderNo"=>"",
            "KeyWord"=>$keyWord,
            "ProductDistributeContry"=>$data['txtDistributeId'],
            "ProductDistributeCountryNames"=>$data['txtDistributeName']
        ]);

        //删除先
        DB::table('infodistribute')->where("InfoID","=",$pid)->where("InfoType","=",1)->delete();


        //保存国家分布
        if(!empty($data['txtDistributeId']))
        {
             $disArr=explode(",",$data['txtDistributeId']);
             $disNameArr=explode(",",$data['txtDistributeName']);


            for($i=0;$i<count($disArr);$i++)
            {
                if(!empty($disArr[$i])){

                    DB::table('infodistribute')->insert([
                            "CountryID"=>$disArr[$i],
                            "Country"=>$disNameArr[$i],
                            "InfoID"=>$pid,
                            "InfoType"=>1,
                            "IsArea"=>0,
                            "Remark"=>""
                    ]);


                }


            }

        }

        //概要图保存
        if(array_key_exists("gaiyaoFile",$_FILES)){

            DB::table('productcolor')->where("PID",$pid)->delete();

            $length =  $_FILES['gaiyaoFile']['name'];
            for($i=0;$i<count($length);$i++)
            {
                $filepath = '';
                $colorID ='0';
                if(empty($_FILES['gaiyaoFile']['name'][$i]))
                {
                    $filepath =$data['gaiyaoFileHidden'][$i];
                }
                else
                {
                    if($file = $qiniu->uploadArrayFormFiles("gaiyaoFile",$i) )
                    {
                        $filepath= $file['filePath'];
                    }
                }

                if(!empty($filepath) && !empty($data['dvProductProfileColor'][$i])){
                    $color = DB::table('basecolor')->where('ColorValue',$data['dvProductProfileColor'][$i])->get();

                    if(!$color)
                    {
                        $colorID = DB::table("basecolor")->insertGetId([
                            'ColorValue'=>$data['dvProductProfileColor'][$i]
                        ]);
                    }
                    else
                    {
                        $colorID = $color[0]->ColorID;
                    }

                    DB::table("productcolor")->insert([
                        'ProductProfileImg'=>$filepath,
                        'ProductCode'=>$data['txtProductCode'],
                        'PID'=>$pid,
                        'ColorID'=>$colorID
                    ]);
                }
            }
        }
    }


    /**
     * @param $pid
     * @return mixed
     */
    public function getProductTypeById($pTypeid) {

        $pTypeidArr = explode(",",$pTypeid);
        $str ="";
        foreach($pTypeidArr as $valID)
        {
            if(!empty($valID)) {
                $sql = "SELECT  GROUP_CONCAT(c1.PTypeName ORDER BY cp.Level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name"
                    . " FROM  rap_producttype_path  cp "
                    . "LEFT JOIN  rap_producttype c1 ON (cp.PathID = c1.PTypeID) ";
                $sql .= " WHERE cp.`PTypeID` =" . $valID;
                $sql .= " GROUP BY cp.PTypeID";

                $result = DB::select(DB::raw($sql));


                foreach ($result as $key => $val) {
                    $str .= $val->name;
                }
            }
        }



        return $str;
    }


    /**
     *  保存产品
     * @param $data
     * @param Data $qiniu
     *
     */
    public  function store($data,Data $qiniu)
    {
        if($file = $qiniu->upload('fileSpecialtyImg')) $data['fileSpecialtyImg'] = $file['filePath'];
        if($file = $qiniu->upload('fileProductImg')) $data['fileProductImg'] = $file['filePath'];


        $length =count($data['maidian']["titlebackground"]);
        $maidainfile=[];

        for($i=0;$i<$length;$i++) {

            $filepath='';
            if($file = $qiniu->uploadArrayFormFiles("maidianfile",$i) )    $filepath= $file['filePath'];

            $maidainfile[]=$filepath;

        }

        //规格
        $productStandard=base64_encode(serialize(($data['ProductStandard'])));

        $data['maidian']['file'] = $maidainfile;
        $maidainJson= base64_encode(serialize($data['maidian']));

        $keyWord=$this->getProductTypeById($data["hidProductTypeID"]);

       $pid= Product::insertGetId([
            "ProductCode"=>$data['txtProductCode'],
            "ProductName"=>$data['txtProductName'],
            "ProductPrice"=>$data["txtProductPrice"],
            "ProductDesc"=>$data["tareaProductDesc"],
            "ProductType"=>$data["hidProductTypeID"],
            "ProductLifeCycle"=>$data["txtProductLifeCycle"],
            "ProductStandard"=>$productStandard,//规格
            "ProductInterface"=>"",
            "ProductNames"=>$data['txtProductTypeName'],
            "ProductShowJSON"=>$maidainJson,//卖点
            "ProductImg"=>isset($data['fileProductImg'])?$data['fileProductImg']:'',//图片
            "ProductBigImg"=>isset($data['fileSpecialtyImg'])?$data['fileSpecialtyImg']:'',//图片
            "LinkMode"=>$data['selLinkMode'],
            "MarketTime"=>$data["txtMarketTime"],
            "Remark"=>$data["tareaRemark"],
            "FavorablePrice"=>$data["txtFavorablePrice"],
            "Popular"=>"",
            "OrderNo"=>"",
            "KeyWord"=>$keyWord,
            "ProductDistributeContry"=>$data['txtDistributeId'],
            "ProductDistributeCountryNames"=>$data['txtDistributeName']
        ]);


        //保存国家分布
        if(!empty($data['txtDistributeId']))
        {
            $disArr=explode(",",$data['txtDistributeId']);
            $disNameArr=explode(",",$data['txtDistributeName']);



            for($i=0;$i<count($disArr);$i++)
            {
                if(!empty($disArr[$i])){
                    DB::table('infodistribute')->insert([
                        "CountryID"=>$disArr[$i],
                        "Country"=>$disNameArr[$i],
                        "InfoID"=>$pid,
                        "InfoType"=>1,
                        "IsArea"=>0,
                        "Remark"=>""
                    ]);
                }

            }

        }

        //是否新品
        if(!empty(trim($data['txtProductExpire'])))
        {
            DB::Table("productnew")->where("PID",$pid)->delete();
            DB::Table("productnew")->insert([
                'PID'=>$pid,
                'ProductCode'=>$data['txtProductCode'],
                'ProductExpire'=>$data['txtProductExpire']
            ]);
        }
        else
        {
            DB::Table("productnew")->where("PID",$pid)->delete();
        }
        //概要图保存

        if(array_key_exists("gaiyaoFile",$_FILES)){
            for($i=0;$i<count($_FILES['gaiyaoFile']['name']);$i++)
            {
                if(!empty($_FILES['gaiyaoFile']['name'][$i]) && $file = $qiniu->uploadArrayFormFiles("gaiyaoFile",$i) )
                {
                    $filepath= $file['filePath'];
                    $color = DB::table('basecolor')->where('ColorValue',$data['dvProductProfileColor'][$i])->get();

                    if($color)
                    {

                        DB::table("productcolor")->insert([
                            'ProductProfileImg'=>$filepath,
                            'ProductCode'=>$data['txtProductCode'],
                            'PID'=>$pid,
                            'ColorID'=>$color[0]->ColorID
                        ]);
                    }
                    else
                    {
                        $colorID = DB::table("basecolor")->insertGetId([
                            'ColorValue'=>$data['dvProductProfileColor'][$i]
                        ]);
                        DB::table("productcolor")->insert([
                            'ProductProfileImg'=>$filepath,
                            'ProductCode'=>$data['txtProductCode'],
                            'PID'=>$pid,
                            'ColorID'=>$colorID
                        ]);
                    }
                }
            }
        }
    }
}


