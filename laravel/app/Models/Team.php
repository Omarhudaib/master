<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'team_leader_id', 'description', 'department_id'];






        public function teamLeader()
        {
            return $this->belongsTo(Employee::class, 'team_leader_id');
        }

        public function projects()
        {
            return $this->hasMany(Project::class);
        }

        public function leader()
        {
            return $this->belongsTo(Employee::class, 'leader_id'); // assuming leader_id is the foreign key
        }

        public function employees()
        {
            return $this->belongsToMany(Employee::class, 'employee_team', 'team_id', 'employee_id');
        }

        public function department() // Add department relationship
        {
            return $this->belongsTo(Department::class);
        }
        // Team.php


    }


