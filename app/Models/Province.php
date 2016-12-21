<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'province';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'ProvinceID';

    
}
