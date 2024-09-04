<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'employee_id',
        'title',
        'description',
        'due_date',
        'status',
    
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function employee()
{
    return $this->belongsTo(Employee::class);
}
}
