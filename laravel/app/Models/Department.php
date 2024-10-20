<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);

    }
    public function location()
    {
        return $this->hasMany(Location::class);
    }
    public function teams() // Add teams relationship
    {
        return $this->hasMany(Team::class);
    }

}
