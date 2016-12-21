<?php

namespace App\Models;

use App\Models\Base;
use App\Http\Models\DocumentType;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDocument extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productdocument';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'DocumentID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['PIDs','DocumentType', 'DocumentName','DocumentDesc','DocumentAttachment','Language','Remark'];

    public function hasOneType()
    {
        return $this->hasOne('\App\Models\DocumentType', 'DocumentTypeID','DocumentType');
    }

    /**
     * 获取相应条件的文章列表
     *
     * @param object $query
     * @param  int  $pageSize 每页文章条数
     * @return array
     */
    
    public function allContents()
    {
        $currentQuery = $this->select('*')->orderBy('DocumentID','desc');
        return $currentQuery;
    }
}
