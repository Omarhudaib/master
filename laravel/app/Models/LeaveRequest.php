<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'status',
        'path', // Ensure path is fillable as a string, not as a datetime
    ];

    protected $casts = [
        // Make sure 'path' is not being cast as 'datetime'
    ];

public function employee()
{
    return $this->belongsTo(Employee::class);
}

}
