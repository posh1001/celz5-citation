<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentCitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'kingschat',
        'unit',
        'designation',
        'department_id',
        'group',
        'title',
        'period_from',
        'period_to',
        'description',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
