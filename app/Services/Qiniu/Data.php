<?php

namespace App\Services\Qiniu;

use zgldh\QiniuStorage\QiniuStorage;
use App\Services\Qiniu\Qiniu;

class Data extends Qiniu
{   
    /**
     * 
     */
    private $name = '';
    /**
     * 预处理数据
     * 
     * @var object
     */
    public function prepareArrayImgData(array $data, $imgName)
    {
        if(isset($data) && is_array($data)){

	        if(isset($data[$imgName])){
	           $data[$imgName] = $this->getDisk()->downloadUrl($data[$imgName]);
	        }

        }
        return $data;
    }

    /**
     * 预处理数据
     * 
     * @var object
     */
    public function prepareObjectImgData($data, $imgName = 'img')
    {
        if(isset($data)){
        	if(isset($data->$imgName)){
	            $data->$imgName = $this->getDisk()->downloadUrl($data->$imgName, 'custom');
	        }
        }
        return $data;
    }

    /**
     * 预处理数据
     * 
     * @var object
     */
    public function prepareDeleteImgData($data)
    {
        if(isset($data)){
            $imgArr = [];
            foreach ($data as $key => $value) {
                ($value->img != '') && $imgArr[] = $value->img;
            }
            !empty($imgArr) && $this->getDisk()->delete($imgArr);
            return $data;
        }
    }

    /**
     * 上传图片
     * 
     * @var object
     */
    public function upload($formname = 'name', $pre = 'img-', $allowed_extensions=["png", "jpg", "gif"])
    {


        if($file = $this->getRequestFile($formname, $allowed_extensions)){
            $qiniuName  = $this->getFileName($pre);
            $this->getDisk()->put($qiniuName, $file['contents']);
            return ['filePath' => $qiniuName];
        } else {
            return false;
        } 
    }

    /**
     * 上传图片
     *
     * @var object
     */
    public function uploadArrayFormFiles($formname = 'name',$index =  0, $pre = 'img-', $allowed_extensions=["image/png", "image/jpeg", "image/gif"])
    {

        if($file = $this->getRequestArrFile($formname,$index, $allowed_extensions)){
            $qiniuName  = $this->getFileName($pre);
            $this->getDisk()->put($qiniuName, $file['contents']);
            return ['filePath' => $qiniuName];
        } else {
            return false;
        }
    }

    /**
     * 获取请求文件信息
     *
     * @var object
     */
    public function getRequestArrFile($formname,$index, $allowed_extensions)
    {


            if($allowed_extensions && is_array($allowed_extensions)){
                if (!in_array($_FILES[$formname]['type'][$index], $allowed_extensions)) {
                    return false;
                }
            }
            return [
                'fileName'  =>$_FILES[$formname]['name'][$index],
                'extension' =>$_FILES[$formname]['type'][$index] ?$_FILES[$formname]['type'][$index]: 'png',
                'contents'  => file_get_contents($_FILES[$formname]['tmp_name'][$index]),
            ];

        return false;
    }
    /**
     * 获取请求文件信息
     * 
     * @var object
     */
    public function getRequestFile($formname, $allowed_extensions)
    {
        if ($file = \Request::file($formname)) {
            if($allowed_extensions && is_array($allowed_extensions)){
                if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                    return false;
                }
            }
            return [
                'fileName'  => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension() ?: 'png',
                'contents'  => file_get_contents($_FILES[$formname]['tmp_name']),
            ];
        }
        return false;
    } 

    /**
     * 获取上传文件名字
     * 
     * @var object
     */
    public function getFileName($pre)
    {
        if($this->name){
            return $this->name;
        } else {
            return $pre.uniqid();
        }
    }

    /**
     * 设置上传文件名字
     * 
     * @var object
     */
    public function setFileName($pre,$name)
    {
        $this->name = $pre.$name;
    }
    
}