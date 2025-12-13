<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCitation extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'kingschat',
        'unit',
        'designation',
        'department_id',
        'title',
        'period_from',
        'period_to',
        'description',
    ];

    // Relationship if needed
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
