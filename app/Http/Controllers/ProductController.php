<?php
/**
 * Created by PhpStorm.
 * User: zhangxiaoqiu
 * Date: 2015/11/20
 * Time: 14:08
 */

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as AbstractController;
use Illuminate\Http\Request;
use App\Services\ProductService as ProductService;
use Illuminate\Support\Facades\View;
use App\Services\Qiniu\Data  as Data;
use Illuminate\Support\Facades\Storage as Storage;

class ProductController extends  AbstractController
{
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
    }

    public function  listProduct()
    {
         $productList=$this->productService->getList();
         return view('product.list')->with("list",$productList)->with('keyword','');
    }

    public function  createProduct()
    {
        return view('product.create');
    }

    public function  selectProductStandard()
    {
        return view('product.productstandard');
    }

    public function  action(Request $request)
    {
       $action = $request->input('action');

        if($action=='search') {
            $productList = $this->productService->getSearchList($request->input('keyword'));
            return view('product.list')->with("list", $productList)->with('keyword', $request->input('keyword'));
        }elseif($action == 'delete') {
            $pids= explode(",",$request->input('pids'));
            $result=$this->productService->deleteProduct($pids);
           return redirect('/product')->withErrors("删除产品成功");
        }
    }

    public function pic(Request $request)
    {
        ob_clean();
        $file=(Storage::disk('local')->get("upload/".$request->input("name")));
        header("Content-Type: image/jpeg;text/html; charset=utf-8");
        echo $file ;
        exit;
    }


    public function  store(Request $request,  Data $qiniu)
    {
        $data = $request->input();
        if($request->input("isReview")==1)
        {
            return    $this->review($request);
        }else
        {
            $this->productService->store($request->input(),$qiniu);
            return redirect('/product')->withErrors("保存产品成功");
        }

    }

    public function review(Request $request)
    {
        $data = $request->input();

        $maidian=$data['maidian'];

        //处理所有的文件
        $productBackgroundPic="";

        //bg
        if(!empty($_FILES['fileSpecialtyImg']['name']))
        {
            Storage::disk('local')->put("upload/" . md5($_FILES["fileSpecialtyImg"]["name"]),file_get_contents($_FILES["fileSpecialtyImg"]["tmp_name"]));
            $productBackgroundPic="/product/pic?name=".md5($_FILES["fileSpecialtyImg"]["name"]);
        }else
        {
            if(!empty($data['fileSpecialtyImgHidden'])){
                $productBackgroundPic =env('QINIU_DOMAINS_CUSTOM').$data['fileSpecialtyImgHidden'];
            }
        }

        //prouduct adv

        $productColorsPic = [];

        foreach($_FILES['gaiyaoFile']['name'] as $k => $v)
        {
            if(!empty($v))
            {
                if(file_exists($_FILES["gaiyaoFile"]["tmp_name"][$k])){

                    Storage::disk('local')->put("upload/" . md5($_FILES["gaiyaoFile"]["name"][$k]),file_get_contents($_FILES["gaiyaoFile"]["tmp_name"][$k]));

                    $productColorsPic[] ="/product/pic?name=".md5($_FILES["gaiyaoFile"]["name"][$k]);;
                }else
                {
                    $productColorsPic[] ="";
                }

            }elseif(!empty($data['gaiyaoFileHidden'][$k]))
            {
                $productColorsPic[] =env('QINIU_DOMAINS_CUSTOM').$data['gaiyaoFileHidden'][$k];
            }else
            {
                $productColorsPic[] = "";
            }
        }

        $productStardard=$data['ProductStandard'];

        //maidian
        $maidianfiles = [];
        if(count($_FILES['maidianfile']['name'])>0)
        {
            for($i=0;$i<count($_FILES['maidianfile']['name']);$i++)
            {
                if(file_exists($_FILES["maidianfile"]["tmp_name"][$i])){

                    Storage::disk('local')->put("upload/" . md5($_FILES["maidianfile"]["name"][$i]),file_get_contents($_FILES["maidianfile"]["tmp_name"][$i]));
                    $maidianfiles[] ="/product/pic?name=".md5($_FILES["maidianfile"]["name"][$i]);;

                }elseif(!empty($data['maidianfilehidden'][$i]))
                {
                    $maidianfiles[]=env('QINIU_DOMAINS_CUSTOM').$data['maidianfilehidden'][$i];
                }
                else
                {
                    $maidianfiles[]="";
                }

            }
        }

        return view("product.detail")->with("product",$data)
            ->with("productColorsPic",$productColorsPic)
            ->with("maidianfiles",$maidianfiles)
            ->with("productBackgroundPic",$productBackgroundPic)
            ->with("maidian",$maidian)
            ->with("productStardard",$productStardard);
    }


    public function  modify(Request $request,  Data $qiniu)
    {
        if($request->input("isReview")==1)
        {
            return    $this->review($request);
        }else{
            $id = $request->input("pid");
            $this->productService->modify($request->input(),$qiniu,$id);
            return redirect('/product')->withErrors("修改产品成功");
        }
    }


    /**
     *  获取product
     */
    public function reviseProduct(Request $request,$id)
    {
        $product = $this->productService->getProduct($id);
        $productDistribute = $this->productService->getProductDistribute($id);

        $disArr=[];
        $disNameArr=[];

        foreach($productDistribute as $key =>$val)
        {
            $disArr[]=$val->CountryID;
            $disNameArr[]=$val->Country;
        }


        $productStardard =[];
        $productShowJSON =[];

        if (!empty($product->ProductStandard)) {
            $productStardard = unserialize(base64_decode($product->ProductStandard));
        }

        if(!empty($product->ProductShowJSON)) {
            $productShowJSON =unserialize(base64_decode($product->ProductShowJSON));
        }

        $productFiles=$this->productService->getProductFiles($id);



        return view('product.edit')->with('product',$product)
            ->with('pid',$id)
            ->with('productStardard',$productStardard)
            ->with('maidian',$productShowJSON)
            ->with("countryName",implode(",",$disNameArr))
            ->with("countryIds",implode(",",$disArr))
            ->with('productFiles',$productFiles);
    }
}