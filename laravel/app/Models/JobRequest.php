<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'job_offer_id', 'cover_letter', 'resume_path'];


    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }
}
