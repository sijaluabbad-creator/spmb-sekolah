<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSchedule extends Model
{
    protected $fillable = [
        'activity',
        'start_date',
        'end_date',
        'note',
    ];
}
