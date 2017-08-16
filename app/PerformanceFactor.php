<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceFactor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'performance_factor';

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
