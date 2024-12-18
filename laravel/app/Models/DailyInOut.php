<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DailyInOut extends Model
{
    protected $table = 'daily_in_out';

    protected $fillable = [
        'employee_id',
        'check_in',
        'check_out',
        'location_in',  // Added location_in
        'location_out', // Added location_out
    ];

    public function employee() // Adjusted the relationship
    {
        return $this->belongsTo(Employee::class); // Assuming there's an Employee model
    }

    public function workedHours()
    {
        if ($this->check_in && $this->check_out) {
            $checkIn = Carbon::parse($this->check_in);
            $checkOut = Carbon::parse($this->check_out);
            return $checkOut->diffInHours($checkIn);
        }
        return 0;
    }
    // Method to calculate total hours worked by the employee
  // Method to calculate total hours worked by the employee
  public function getTotalHours()
  {
      $totalHours = 0;

      foreach ($this->dailyInOut as $attendance) {
          if ($attendance->check_in && $attendance->check_out) {
              $checkIn = Carbon::parse($attendance->check_in);
              $checkOut = Carbon::parse($attendance->check_out);
              $totalHours += $checkOut->diffInHours($checkIn);
          }
      }

      return $totalHours;
  }
  public function locationIn()
{
    return $this->belongsTo(Location::class, 'location_in_id'); // Adjust 'location_in_id' to your actual foreign key
}

public function locationOut()
{
    return $this->belongsTo(Location::class, 'location_out_id'); // Adjust 'location_out_id' to your actual foreign key
}

}
