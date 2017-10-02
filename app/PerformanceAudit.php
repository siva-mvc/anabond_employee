<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceAudit extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'performance_audit';
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}

// CREATE TABLE IF NOT EXISTS `performance_audit` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `employee_id` int(11) DEFAULT NULL,
//   `year` int(11) DEFAULT NULL,
//   `total_score` decimal(50,2) DEFAULT NULL,
//   `experience` decimal(50,2) DEFAULT NULL,
//   `future_prospect` decimal(50,2) DEFAULT NULL,
//   `raw_total` decimal(50,2) DEFAULT NULL,
//   `created_by` varchar(250) DEFAULT NULL,
//   `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
//   `updated_at` timestamp NULL DEFAULT NULL,
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
