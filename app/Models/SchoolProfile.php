<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'school_name',
        'school_npsn',
        'school_accreditation',
        'school_contact',
        'principal_name',
        'principal_id',
        'address',
        'logo_path',
    ];
}
