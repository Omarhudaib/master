<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'latitude', 'longitude', 'department_id'];

    // Define the relationship with Department if applicable
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
