<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'country';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'CountryID';

    
}
