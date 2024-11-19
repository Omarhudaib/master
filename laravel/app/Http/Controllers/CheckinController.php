<?php

namespace App\Http\Controllers;

use App\Models\DailyInOut;
use App\Models\Location;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    public function checkIn(Request $request)
    {
        // Validate the input location
        $validated = $request->validate([
            'location_in' => 'required|regex:/^-?\d+\.\d+,\s?-?\d+\.\d+$/',  // Ensure the format is valid
        ]);

        // Get the authenticated employee
        $employee = Auth::user()->employee;

        // Get locations related to the employee's department
        $locations = Location::where('department_id', $employee->department_id)->get();

        if ($locations->isEmpty()) {
            return response()->json(['error' => 'No locations found for your department.'], 400);
        }

        // Get the first expected location
        $expectedLocation = $locations->first();

        // Get the submitted location
        $submittedLocation = $validated['location_in'];
        list($latitude, $longitude) = explode(',', $submittedLocation);

        // Calculate the distance between the submitted location and the expected location
        $distance = $this->haversineGreatCircleDistance(
            (float) $expectedLocation->latitude,
            (float) $expectedLocation->longitude,
            (float) $latitude,
            (float) $longitude
        );

        $acceptableDistance = 0.1; // 100 meters in kilometers

        if ($distance > $acceptableDistance) {
            return response()->json([
                'error' => 'The selected location is too far from the expected location: ' . $expectedLocation->name .
                           ' (Distance: ' . round($distance, 2) . ' km, Acceptable: ' . $acceptableDistance . ' km)'
            ], 400);
        }

        // Check if the employee has already checked in today
        $today = now()->format('Y-m-d');
        $existingCheckIn = DailyInOut::where('employee_id', $employee->id)
                                       ->whereDate('check_in', $today)
                                       ->first();

        if ($existingCheckIn) {
            return response()->json(['error' => 'You have already checked in today.'], 400);
        }

        // Create a new check-in record
        DailyInOut::create([
            'employee_id' => $employee->id,
            'check_in' => now(),
            'location_in' => $submittedLocation,
        ]);

        return response()->json(['success' => 'You have checked in successfully.'], 200);
    }

    public function checkOut(Request $request)
    {
        $employee = Auth::user()->employee;

        // Get locations related to the employee's department
        $locations = Location::where('department_id', $employee->department_id)->get();

        if ($locations->isEmpty()) {
            return response()->json(['error' => 'No locations found for your department.'], 400);
        }

        // Get the first expected location (You may change this logic if needed)
        $expectedLocation = $locations->first();

        // Validate the submitted location format (latitude, longitude)
        $submittedLocation = $request->input('location_out');
        if (empty($submittedLocation)) {
            return response()->json(['error' => 'Location is required.'], 400);
        }

        // Check if the location format is correct (latitude, longitude)
        if (preg_match('/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s?[-+]?((1[0-7]\d)|([1-9]?\d))(\.\d+)?$/', $submittedLocation) === 0) {
            return response()->json(['error' => 'Location format is invalid. Please provide latitude and longitude.'], 400);
        }

        // Split the latitude and longitude
        list($latitude, $longitude) = explode(',', $submittedLocation);

        // Calculate the distance between the submitted location and the expected location
        $distance = $this->haversineGreatCircleDistance(
            (float) $expectedLocation->latitude,
            (float) $expectedLocation->longitude,
            (float) $latitude,
            (float) $longitude
        );

        $acceptableDistance = 0.1; // 100 meters in kilometers

        if ($distance > $acceptableDistance) {
            return response()->json([
                'error' => 'The selected location is too far from the expected location: ' . $expectedLocation->name .
                           ' (Distance: ' . round($distance, 2) . ' km, Acceptable: ' . $acceptableDistance . ' km)'
            ], 400);
        }

        // Check if the employee has already checked out today
        $today = now()->format('Y-m-d');
        $existingCheckOut = DailyInOut::where('employee_id', $employee->id)
                                      ->whereDate('check_out', $today)
                                      ->first();

        if ($existingCheckOut) {
            return response()->json(['error' => 'You have already checked out today.'], 400);
        }

        // Ensure that the employee has checked in today
        $latestCheckIn = DailyInOut::where('employee_id', $employee->id)
                                    ->whereDate('check_in', $today)
                                    ->whereNull('check_out')
                                    ->first();

        if (!$latestCheckIn) {
            return response()->json(['error' => 'You have not checked in today.'], 400);
        }

        // Update the existing check-in record to set check-out time and location
        $latestCheckIn->update([
            'check_out' => now(),
            'location_out' => $submittedLocation,
        ]);

        return response()->json(['success' => 'You have checked out successfully.'], 200);
    }

    // دالة لحساب المسافة بين نقطتين باستخدام معادلة هافرسين
    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        $latitudeFrom = deg2rad($latitudeFrom);
        $longitudeFrom = deg2rad($longitudeFrom);
        $latitudeTo = deg2rad($latitudeTo);
        $longitudeTo = deg2rad($longitudeTo);

        $latDifference = $latitudeTo - $latitudeFrom;
        $lonDifference = $longitudeTo - $longitudeFrom;

        $a = sin($latDifference / 2) * sin($latDifference / 2) +
             cos($latitudeFrom) * cos($latitudeTo) *
             sin($lonDifference / 2) * sin($lonDifference / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
