<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'date_of_birth', 'hire_date',
        'department_id', 'position_id', 'salary', 'national_id',
        'marital_status', 'phone_number', 'employee_identifier',
        'sick_leaves', 'annual_vacation_days'
    ];


    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    // Relationship with User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Teams
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'employee_team', 'employee_id', 'team_id');
    }

    // Relationship with Tasks
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    // Relationship with Department
    public function dailyInOuts()
    {
        return $this->hasMany(DailyInOut::class);
    }

    // Relationship with Position
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
    public function employeeRelations()
    {
        return $this->hasMany(EmployeeRelation::class);
    }

    public function relatedTo()
    {
        return $this->hasMany(EmployeeRelation::class, 'related_employee_id');
    }
    // Remove redundant or incorrect method
     // Relationships
     public function dailyInOut()
     {
         return $this->hasMany(DailyInOut::class);
     }

     // Optionally, you can have a method to check if the employee is on an off day
     public function isOnOffDay()
     {
         $today = Carbon::today();

         // Check if the employee has a leave or off day today (adjust according to your schema)
         return $this->leaves()->whereDate('start_date', '<=', $today)
                               ->whereDate('end_date', '>=', $today)
                               ->exists();
     }

     // Relationship to the leaves/off-days table
     public function leaves()
     {
         return $this->hasMany(Leave::class); // Assuming Leave model exists
     }
}
