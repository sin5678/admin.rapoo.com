<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class ColorDistribute extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'colordistribute';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'CID';

    
}
