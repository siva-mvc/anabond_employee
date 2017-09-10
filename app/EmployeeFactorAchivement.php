<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeFactorAchivement extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee_target_achivement';
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
