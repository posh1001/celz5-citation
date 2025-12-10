<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentForm extends Model
{
    use HasFactory;

    protected $table = 'department_forms';

    protected $fillable = [
        'title',
        'fullname',
        'unit',
        'designation',
        'kingschat',
        'phone',
        'department',
        'period',
        'citation',
    ];
}
