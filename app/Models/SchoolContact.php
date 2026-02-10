<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolContact extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'website',
        'instagram',
        'address',
        'coordinate',
        'maps_link',
        'operational_hours',
    ];
}
