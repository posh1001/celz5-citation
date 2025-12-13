<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'fullname',
        'unit',
        'designation',
        'kingschat',
        'phone',
        'department',
        'group_name',
        'period',
        'citation'
    ];
}
