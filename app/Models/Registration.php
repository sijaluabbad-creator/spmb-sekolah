<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'student_name',
        'nisn',
        'birth_date',
        'level',
        'parent_name',
        'parent_phone',
        'address',
        'birth_certificate_path',
        'family_card_path',
        'mother_id_path',
        'photo_path',
    ];
}
