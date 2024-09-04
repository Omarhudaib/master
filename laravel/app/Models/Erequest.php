<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Erequest extends Model
{
    use HasFactory;
    protected $table=  'requests';
      protected $fillable = [ 'status'];

    // Define the relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
