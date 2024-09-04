<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Models\Task;
use App\Models\Employee;
use App\Models\Position;
use App\Models\DailyInOut;
use App\Models\Department;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function indexEmployee()
    {
        $userId = Auth::id(); // Get the authenticated user's ID

        // Get employees related to the authenticated user
        $employees = Employee::where('user_id', $userId)
            ->with(['department', 'position'])
            ->get();

        // Get tasks related to the authenticated user
        $tasks = Task::whereHas('employee', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('employee')->get();

        // Get departments associated with employees
        $departments = Department::whereHas('employees', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        // Get positions associated with employees
        $positions = Position::whereHas('employees', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        // Get leave requests associated with employees
        $leaveRequests = LeaveRequest::whereHas('employee', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        // Return the view with the necessary data
        return view('employee.home_employee', compact('employees', 'tasks', 'departments', 'positions', 'leaveRequests'));
    }

// EmployeeController.php
public function edit($id)
{
    $user = User::findOrFail($id);
    return view('employee.employee_p', compact('user'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user = User::findOrFail($id);
    $data = $request->only('name', 'email');

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $user->update($data);

    return redirect()->route('employee_p.show', $user->id)->with('success', 'User updated successfully');
}


public function handleDayAction(Request $request)
{
    $action = $request->input('action');
    $userId = auth()->id(); // Assuming you are using authentication to get the user ID
    $currentDate = Carbon::now()->toDateString(); // Get current date
    $currentTime = Carbon::now(); // Get current time

    if ($action === 'start') {
        // Logic to start the day
        DailyInOut::updateOrCreate(
            ['employee_id' => $userId, 'date' => $currentDate], // Ensure 'employee_id' and 'date' match schema
            ['check_in' => $currentTime, 'check_out' => null] // Ensure field names match model attributes
        );
    } elseif ($action === 'end') {
        // Logic to end the day
        DailyInOut::updateOrCreate(
            ['employee_id' => $userId, 'date' => $currentDate], // Ensure 'employee_id' and 'date' match schema
            ['check_out' => $currentTime] // Ensure field names match model attributes
        );
    }

    return redirect()->back()->with('status', 'Action completed successfully.');
}
public function ticketEmployee()
{
    $userId = Auth::id(); // Get the authenticated user's ID

    // Get tasks related to the authenticated user
    $tasks = Task::whereHas('employee', function ($query) use ($userId) {
        $query->where('user_id', $userId);
    })->with('employee')->get();

    // Calculate counts based on task status
    $totalTickets = $tasks->count();
    $responded = $tasks->where('status', 'Responded')->count();
    $resolved = $tasks->where('status', 'Resolved')->count();
    $pending = $tasks->where('status', 'Pending')->count();

    // Return the view with the necessary data
    return view('employee.ticket_list', compact('tasks', 'totalTickets', 'responded', 'resolved', 'pending'));
}
public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:In Progress,Completed,On Hold',
        ]);

        $task->status = $request->input('status');
        $task->save();

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }


}
