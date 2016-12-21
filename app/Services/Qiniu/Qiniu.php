<?php

namespace App\Services\Qiniu;

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Config;
use zgldh\QiniuStorage\QiniuStorage;

class Qiniu
{   

    /**
     * 
     * @var object
     */
    public $disk;

    /**
     * 模型
     * 
     * @var string
     */
    public $bucket;

    /**
     *
     * @access public
     */
    public function getDisk()
    {
        if($this->disk){
            return $this->disk;
        } else {
            return $this->disk = QiniuStorage::disk('qiniu');
        }
    }

    /**
     *
     * @access public
     */
    public function setDisk($disk)
    {
        return $this->disk = QiniuStorage::disk($disk);
    }

    /**
     *
     * @access public
     */
    public function getAuth()
    {
        return new Auth($this->getAccessKey(), $this->getSecretKey());
    }

    /**
     *
     * @access public
     */
    public function getBucket()
    {
        return Config::get('filesystems.disks.qiniu.bucket');
    }

    /**
     *
     * @access public
     */
    public function getAccessKey()
    {
        return Config::get('filesystems.disks.qiniu.access_key');
    }    

    /**
     *
     * @access public
     */
    public function getSecretKey()
    {
        return Config::get('filesystems.disks.qiniu.secret_key');
    } 

}