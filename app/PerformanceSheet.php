<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceSheet extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'performance_sheet';
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
