<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'related_employee_id',
        'relation_type'
    ];

    // Define relationship to the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function relatedEmployee()
    {
        return $this->belongsTo(Employee::class, 'related_employee_id');
    }
}
