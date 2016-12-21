<?php

namespace App\Services\Qiniu;

use App\Services\Qiniu\Qiniu;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

class QiniuList extends Qiniu
{   
    /**
     * 模型
     * 
     * @var object
     */
    public $bucketMgr;

    /**
     *
     * @access public
     */
    public function getBucketMgr()
    {
        return new BucketManager($this->getAuth());
    }
     
    /**
     * 获取上传文件列表
     * 
     * @var object
     */
    public function getFileList($prefix = 'img-',$marker = '',$limit = 0)
    {
        $iterms = [];
        list($iterms, $marker, $err) = $this->getBucketMgr()->listFiles($this->getBucket(), $prefix, $marker, $limit);
        if ($err !== null) {
            var_dump($err);exit;
        } else {
            return $iterms;
        }
    }
    
}