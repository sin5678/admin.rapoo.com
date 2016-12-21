<?php

namespace App\Services;

use App\Models\ProductTranslate;
use App\Http\Requests;
use App\Http\Requests\ProductTranslateRequest;
use App\Services\BaseService;
use Auth,BaseController,Input,Redirect,Request;
use App\Services\Qiniu\Data  as Data;

class ProductTranslateService extends BaseService
{
    

    /**
     * 初始化
     *
     * @access public
     */
    public function __construct(ProductTranslate $ProductTranslate)
    {
        
         parent::__construct();
         $this->ProductTranslateModel = new ProductTranslate;
      
    }

    /**
     * 初始化
     *
     * @access public
     */
    public function getModel()
    {
        return $this->ProductTranslateModel;
    }
 
    /**
     * 视频列表呈现
     *
     * @param int $pageSize 每页条数
     * @return array
     */
    public function index($search, $pageSize=10)
    {   
        $builder = $this->ProductTranslateModel->allContents();
        $builder = $search->getSearch($builder);
        return $builder->paginate($pageSize);
    }
     /**
     * 执行编辑翻译
     *
     * @param (arr) $data
     */
    public function store($data,Data $qiniu)
    {
    
        $id = $data['TranslateID'];

           
	    $length =count($data['maidian']["titlebackground"]);
        $maidainfile=[];

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
        //规格
        $productStandard=base64_encode(serialize(($data['ProductStandard'])));

        $data['maidian']['file'] = $maidainfile;
        $maidainJson= base64_encode(serialize($data['maidian']));

        $dataSql['PID']    = $data['PID'];
        $dataSql['Language']  = $data['VideoType'];
        $dataSql['ProductName']  = $data['ProductName'];
        $dataSql['ProductDesc']  = $data['ProductDesc'];
        $dataSql['region'] = $dataSql['Language'];
        if($data['VideoType'] =='zh-CN') {
            $dataSql['ProductStandard']  = $productStandard;
        }
        $dataSql['ProductShowJSON']  = $maidainJson;

        if(isset($data['txtCountryName'])){
             $txtCountryName =  $data['txtCountryName'];
            foreach($txtCountryName as $key => $value) {

                 $dataSql['Language'] = $value;

                 $TranslateID = $this->ProductTranslateModel->getProductTranslate($dataSql['PID'],$value);

                 if($TranslateID){
                    $this->ProductTranslateModel->editProductTranslate($dataSql , $TranslateID['TranslateID']);
                 } else {
                    $this->ProductTranslateModel->addProductTranslate($dataSql);
                }
                 
            }
        }
        return $this->ProductTranslateModel->editProductTranslate($dataSql , $id);

    }
    /**
     * 执行添加翻译
     *
     * @param (arr) $data
     */
    public function createProductTranslate($data,Data $qiniu)
    {
     
		//如果图片没有修改就还用原来的
        if(empty($_FILES['fileProductImg']['name']))
        {
            $data['fileProductImg']=$data['maidianfilehidden'];
        }else
        {
            if($file = $qiniu->upload('fileProductImg')) $data['fileProductImg'] = $file['filePath'];
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
    
        //规格
        $productStandard=base64_encode(serialize(($data['ProductStandard'])));

        $dataSql['PID']    = $data['PID'];
        $dataSql['Language']  = $data['VideoType'];
        $dataSql['region']  = $data['VideoType'];
        $dataSql['ProductName']  = $data['ProductName'];
        $dataSql['ProductDesc']  = $data['ProductDesc'];
        
        if($data['VideoType'] =='zh-CN') {
            $dataSql['ProductStandard']  = $productStandard;
        }

        $dataSql['ProductShowJSON']  = $maidainJson;
        if(isset($data['txtCountryName'])){
         $txtCountryName = $data['txtCountryName'];
         foreach($txtCountryName as $key => $value) {
            
                 $dataSql['Language'] = $value;
                 $TranslateID = $this->ProductTranslateModel->getProductTranslate($dataSql['PID'],$value);

                 if($TranslateID){
                    $this->ProductTranslateModel->editProductTranslate($dataSql,$TranslateID['TranslateID']);
                 } else {
                    $this->ProductTranslateModel->addProductTranslate($dataSql);
                }
            }
         }
         $this->ProductTranslateModel->addProductTranslate($dataSql);
       
        }
    /**
     * 执行删除翻译
     *
     * @param (arr) $data
     */
    public function delete($request)
    {

       return  $this->ProductTranslateModel->delProductTranslate($request);
       
     }
}