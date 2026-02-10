<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolLevelSetting extends Model
{
    protected $fillable = [
        'level',
        'is_active',
        'academic_year',
        'semester',
    ];
}
