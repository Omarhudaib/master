<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class ApiEmployeeController extends Controller
{
    // Get the employee's details for editing
    public function edit()
    {
        $employee = auth()->user()->employee;  // Assuming user has a related employee

        if (!$employee) {
            return response()->json(['message' => 'Employee not found.'], 404);
        }

        // Fetch user details (name, email) related to the employee
        $user = $employee->user; // Assuming you have a relationship in the Employee model

        return response()->json([
            'employee' => $employee,
            'user' => $user, // Return user details along with employee data
        ], 200);
    }


    // Update the employee's details
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        // Validate the input
        $validatedData = $request->validate([
            'date_of_birth' => 'required|date',
            'national_id' => 'required|string|max:255',
            'marital_status' => 'required|string|in:single,married',
            'phone_number' => 'required|string|max:255',
            'employee_identifier' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Update the employee's details
        $employee->update([
            'date_of_birth' => $validatedData['date_of_birth'],
            'national_id' => $validatedData['national_id'],
            'marital_status' => $validatedData['marital_status'],
            'phone_number' => $validatedData['phone_number'],
            'employee_identifier' => $validatedData['employee_identifier'],
        ]);

        // Assuming the 'user' relationship exists, update the related user (name, email)
        $user = $employee->user;
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return response()->json([
            'message' => 'Employee and user details updated successfully.',
            'employee' => $employee,
            'user' => $user, // Return updated user details
        ], 200);
    }

    public function storer(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|in:Sick,Vacation,Maternity,Paternity,Unpaid',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5000', // Use 'attachment' here
        ]);

        $validatedData['status'] = 'Pending'; // Set default status

        // Handle file upload if a file is present
        if ($request->hasFile('attachment')) {
            // Store the file and manually set the 'path' attribute
            $validatedData['path'] = $request->file('attachment')->store('leave_requests', 'public');
        }

        // Create the leave request with validated data
        $leaveRequest = LeaveRequest::create($validatedData);

        // Return a JSON response with the created leave request
        return response()->json([
            'success' => true,
            'message' => 'Leave request created successfully.',
            'data' => $leaveRequest
        ], 201); // 201 for Created
    }

public function indexre()
{
    // Get the authenticated employee's ID
    $employeeId = auth()->user()->employee->id ?? null;

    // Check if employee ID is available
    if (!$employeeId) {
        return response()->json([
            'success' => false,
            'message' => 'Employee not found.'
        ], 404);
    }

    // Retrieve all leave requests for the authenticated employee
    $leaveRequests = LeaveRequest::where('employee_id', $employeeId)->get();

    // Return the leave requests as a JSON response
    return response()->json([
        'success' => true,
        'data' => $leaveRequests
    ]);
}


}
