<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'company', 'location', 'type', 'salary'];

    public function jobRequests()
    {
        return $this->hasMany(JobRequest::class);
    }
}
