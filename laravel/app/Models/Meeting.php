<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
// In your Meeting model
protected $fillable = [
    'subject',
    'meeting_date',
    'location',
    'organizer_id',
    'manager_id',
];


    public function participants()
    {
        return $this->belongsToMany(User::class);
    }
    public function organizer()
{
    return $this->belongsTo(Employee::class, 'organizer_id');
}

public function manager()
{
    return $this->belongsTo(Employee::class, 'manager_id');
}
}
