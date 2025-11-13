<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'field_name', // Add the field name here
        // other_fillable_fields
    ];
}