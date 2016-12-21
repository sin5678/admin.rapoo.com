<?php

namespace App\Models;

use App\Models\Base;

class Logfail extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logfail';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['num', 'ip', 'updated_at'];

}
