<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    // In app/Models/LeaveRequest.php
public function employee()
{
    return $this->belongsTo(Employee::class);
}

}
