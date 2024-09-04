<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    // In app/Models/Position.php
    protected $fillable = [
        'department_id',
        'title',
        'description',
    ];
public function employees()
{
    return $this->hasMany(Employee::class);
}
public function department()
{
    return $this->belongsTo(Department::class);
}
}
