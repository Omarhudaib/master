<?php

namespace App\Http\Controllers;

use App\Models\DailyInOut;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeRelation;
use App\Models\Erequest;
use App\Models\JobRequest;
use App\Models\LeaveRequest;
use App\Models\Meeting;
use App\Models\Message;
use App\Models\Position;
use App\Models\Role;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;


    use Carbon\Carbon;

class HrController extends Controller
{








        public function indexa()
        {
            $today = Carbon::today(); // Get today's date

            // Get all employees with their attendance records for today
            $employees = Employee::with(['dailyInOut' => function ($query) use ($today) {
                $query->whereDate('check_in', $today);
            }])->get();

            // Optionally, you can have an off-day or leave status check here
            // assuming there is a `leaves` or `off_days` table:
            // $employees->load(['leaves' => function ($query) use ($today) {
            //     $query->whereDate('start_date', '<=', $today)->whereDate('end_date', '>=', $today);
            // }]);

            return view('hr.attendance', compact('employees'));
        }








    public function index()
{

 $employees=Employee::all();

 $employeeId = auth()->user()->employee->id;

    $latestCheckIn = DailyInOut::where('employee_id', $employeeId)
                                ->orderBy('check_in', 'desc')
                                ->first();

    // Determine if the user can check in or check out
    $canCheckIn = is_null($latestCheckIn) || $latestCheckIn->check_out;
    $canCheckOut = !$canCheckIn && now()->diffInHours($latestCheckIn->check_in) >= 9;





    return view('hr.home_hr', compact('latestCheckIn', 'canCheckIn', 'canCheckOut','employees'));
}


public function showall()
{
    // Check if the authenticated user has an associated employee
    if (auth()->user() && auth()->user()->employee) {
        $employeeId = auth()->user()->employee->id;

        $latestCheckIn = DailyInOut::where('employee_id', $employeeId)
                                   ->orderBy('check_in', 'desc')
                                   ->first();

        // Determine if the user can check in or check out
        $canCheckIn = is_null($latestCheckIn) || $latestCheckIn->check_out;
        $canCheckOut = !$canCheckIn && now()->diffInHours($latestCheckIn->check_in) >= 9;
    } else {
        // Handle the case where the user doesn't have an employee record
        $employeeId = null;
        $latestCheckIn = null;
        $canCheckIn = false;
        $canCheckOut = false;
    }

    $employees = Employee::with(['department', 'position', 'user', 'user.role', 'teams'])->paginate(20);
    $roles = Role::all();
    $departments = Department::all();
    $positions = Position::all();
    $teams = Team::all();

    return view('hr.home_hr', compact('latestCheckIn', 'canCheckIn', 'canCheckOut', 'employees', 'roles', 'departments', 'positions', 'teams'));
}


public function showemployee()
{

    // Retrieve users who do not have an associated employee record
    $users = User::whereDoesntHave('employee')->get();

    // Retrieve all employees along with related department, position, user, and teams
    $employees = Employee::with(['department', 'position', 'user', 'user.role', 'teams'])->get();
    $roles = Role::all();
    $departments = Department::all();
    $positions = Position::all();
    $teams = Team::all();

    // Return the view with the employee data
    return view('hr.employees_addh', compact('employees',  'users', 'roles', 'departments', 'positions', 'teams'));
}


public function store(Request $request)
{
    $data = $request->validate([
        'user_id' => 'required|exists:users,id',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'date_of_birth' => 'nullable|date',
        'hire_date' => 'nullable|date',
        'department_id' => 'nullable|exists:departments,id',
        'position_id' => 'nullable|exists:positions,id',
        'salary' => 'nullable|numeric',
        'national_id' => 'nullable|string|max:255',
        'marital_status' => 'nullable|in:single,married',
        'phone_number' => 'nullable|string|max:20',
        'employee_identifier' => 'nullable|string|max:255',
        'sick_leaves' => 'nullable|integer',
        'annual_vacation_days' => 'nullable|integer',
    ]);

    $employee = Employee::create($data);

    // Handle Employee Relations
    if ($request->has('related_employee_id')) {
        foreach ($request->related_employee_id as $index => $related_employee_id) {
            EmployeeRelation::create([
                'employee_id' => $employee->id,
                'related_employee_id' => $related_employee_id,
                'relation_type' => $request->relation_type[$index],
            ]);
        }
    }

    return redirect()->route('employeesh')->with('success', 'Employee created successfully.');
}




    public function edith($id)
    {
        $employee = Employee::findOrFail($id);
        $user = $employee->user;
        $roles = Role::all();
        $departments = Department::all();
        $positions = Position::all();
        $teams = Team::all();

        return view('hr.employees_edit', compact('employee', 'user', 'roles', 'departments', 'positions', 'teams'));
    }

public function show($id)
{
    $employee = Employee::with(['user.role', 'department', 'position', 'teams'])->findOrFail($id);
    return view('hr.employeesh_show', compact('employee'));
}
public function update(Request $request, $id)
{
    // Retrieve the employee and associated user
    $employee = Employee::findOrFail($id);
    $user = $employee->user;

    // Validate the request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
        'password' => 'nullable|string|min:8',
        'role_id' => 'required|exists:roles,id',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'department_id' => 'nullable|exists:departments,id',
        'position_id' => 'nullable|exists:positions,id',
        'team_id' => 'nullable|exists:teams,id',
        'salary' => 'nullable|numeric',
        'date_of_birth' => 'nullable|date',
       'hire_ date' => 'nullable|date',
        'national_id' => 'nullable|string|max:255',
        'marital_status' => 'nullable|in:single,married',
        'phone_number' => 'nullable|string|max:20',
        'employee_identifier' => 'nullable|string|max:255',
        'sick_leaves' => 'nullable|integer',
        'annual_vacation_days' => 'nullable|integer',
    ]);

    // Update user information
    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'role_id' => $validated['role_id'],
        'username' => strtolower(str_replace(' ', '_', $validated['name'])),
    ]);

    // Update password if provided
    if (!empty($validated['password'])) {
        $user->update([
            'password' => bcrypt($validated['password']),
        ]);
    }

    // Update employee information
    $employee->update([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'department_id' => $validated['department_id'],
        'position_id' => $validated['position_id'],
        'team_id' => $validated['team_id'],
        'salary' => $validated['salary'],
        'date_of_birth' => $validated['date_of_birth'],
        'hire_date' => $validated['hire_date'],
        'national_id' => $validated['national_id'],
        'marital_status' => $validated['marital_status'],
        'phone_number' => $validated['phone_number'],
        'employee_identifier' => $validated['employee_identifier'],
        'sick_leaves' => $validated['sick_leaves'],
        'annual_vacation_days' => $validated['annual_vacation_days'],
    ]);

    return redirect()->route('employeesh')->with('success', 'Employee updated successfully.');
}

public function destroy($id)
{
    $employee = Employee::findOrFail($id);
    $employee->delete();

    return redirect()->route('employeesh')->with('success', 'Employee deleted successfully');
}





public function checkIn()
{
    $employeeId = auth()->user()->employee->id;

    // Insert check-in time
    DailyInOut::create([
        'employee_id' => $employeeId,
        'check_in' => now(),
    ]);

    return redirect()->back()->with('success', 'Checked in successfully.');
}

public function checkOut()
{
    $employeeId = auth()->user()->employee->id;

    // Update the check-out time
    $dailyInOut = DailyInOut::where('employee_id', $employeeId)
                            ->whereNull('check_out')
                            ->orderBy('check_in', 'desc')
                            ->first();

    if ($dailyInOut) {
        $dailyInOut->update(['check_out' => now()]);
    }

    return redirect()->back()->with('success', 'Checked out successfully.');
}









public function editat($id)
{
    $attendance = DailyInOut::findOrFail($id);
    return view('hr.attendance_edit', compact('attendance'));
}
public function updateat(Request $request, $id)
{
    $attendance = DailyInOut::findOrFail($id);

    // Make sure the keys 'check_in' and 'check_out' match your form inputs
    $attendance->check_in = $request->input('check_in');
    $attendance->check_out = $request->input('check_out');

    $attendance->save();

    return redirect()->route('attendance.indexx')->with('success', 'Attendance updated successfully.');
}












public function indexDepartment()
{
    // Get all departments
    $departments = Department::all();

    // Return the view with departments data
    return view('hr.department', compact('departments'));
}

// Method to create a new department
public function createDepartment(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    // Create the department
    Department::create([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    // Redirect back to the index method with success message
    return redirect()->route('departmentsh')->with('success', 'Department created successfully.');
}



















// Display a listing of the resource.
public function indexPosition()
{
    $positions = Position::with('department')->get();
    return view('hr.positions', compact('positions'));
}

// Show the form for creating a new resource.
public function createPosition()
{
    $departments = Department::all();
    return view('hr.positions_create', compact('departments'));
}

// Store a newly created resource in storage.
public function storePosition(Request $request)
{
    $request->validate([
        'department_id' => 'required|exists:departments,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    Position::create($request->all());

    return redirect()->route('positionsh.index')->with('success', 'Position created successfully.');
}

// Display the specified resource.
public function showPosition(Position $position)
{
    return view('hr.positions_show', compact('position'));
}

// Show the form for editing the specified resource.
public function editPosition(Position $position)
{
    $departments = Department::all();
    return view('hr.positions_edit', compact('position', 'departments'));
}

// Update the specified resource in storage.
public function updatePosition(Request $request, Position $position)
{
    $request->validate([
        'department_id' => 'required|exists:departments,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $position->update($request->all());

    return redirect()->route('positionsh.index')->with('success', 'Position updated successfully.');
}

// Remove the specified resource from storage.
public function destroyPosition(Position $position)
{
    $position->delete();

    return redirect()->route('positionsh.index')->with('success', 'Position deleted successfully.');
}




public function indexm($employeeId)
{
    $employees = Employee::all();
    $employee = Employee::findOrFail($employeeId);
    $senderId = auth()->user()->employee->id;
    $messages = Message::where(function ($query) use ($senderId, $employeeId) {
        $query->where('sender_id', $senderId)
              ->where('receiver_id', $employeeId);
    })
    ->orWhere(function ($query) use ($senderId, $employeeId) {
        $query->where('sender_id', $employeeId)
              ->where('receiver_id', $senderId);
    })
    ->latest()
    ->take(10)
    ->get()
    ->reverse();
    return view('hr.chat', compact('employee', 'employees', 'messages'));
}

public function showm($employeeId)
{
    $employees = Employee::all();
    $employee = Employee::findOrFail($employeeId);
    $senderId = auth()->user()->employee->id;

    $messages = Message::where(function ($query) use ($senderId, $employeeId) {
            $query->where('sender_id', $senderId)
                  ->where('receiver_id', $employeeId);
        })
        ->orWhere(function ($query) use ($senderId, $employeeId) {
            $query->where('sender_id', $employeeId)
                  ->where('receiver_id', $senderId);
        })
        ->latest()
        ->take(10)
        ->get()
        ->reverse();

    return view('hr.chat', compact('employee', 'employees', 'messages'));
}



public function send(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:employees,id', // Validate against employee IDs
        'subject' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    Message::create([
        'sender_id' => auth()->user()->employee->id, // Use the logged-in user's employee ID as sender_id
        'receiver_id' => $request->receiver_id,
        'subject' => $request->subject,
        'body' => $request->body,
    ]);

    return redirect()->route('chath.show', $request->receiver_id)->with('success', 'Message sent!');
}















public function indexMeeting()
{
    $meetings = Meeting::with(['organizer', 'manager'])->get();
    return view('hr.meetings', compact('meetings'));
}








public function indexreq()
{
    $requests = Erequest::with('employee')->get();
    return view('hr.requests', compact('requests'));
}
// Update request status
public function updateStatusreq(Request $request, $id)
{
$requestData = $request->validate([
'status' => 'required|in:Pending,Approved,Rejected',
]);

$request = Erequest::findOrFail($id);
$request->status = $requestData['status'];
$request->save();

return redirect()->route('requestsh.index')->with('success', 'Request status updated successfully.');
}

// Delete request
public function destroyreq(Erequest $erequest)
{
    $erequest->delete();
    return redirect()->route('requestsh.index')->with('success', 'Request deleted successfully.');
}





public function indexteams()
{
    $teams = Team::with('employees')->get();
    $assignedEmployeeIds = Employee::whereHas('teams')->pluck('id')->toArray(); // Get IDs of assigned employees
    $availableEmployees = Employee::whereNotIn('id', $assignedEmployeeIds)->get(); // Get employees not in a team
    return view('hr.teams', compact('teams', 'availableEmployees'));
}




public function createteams()
{
    $employees = Employee::all();
    return view('hr.teams_create', compact('employees'));
}

public function storeteams(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'team_leader_id' => 'required|exists:employees,id',
        'description' => 'nullable|string',
    ]);

    Team::create($validated);
    return redirect()->route('teamsh.index')->with('success', 'Team created successfully.');
}

public function showteams(Team $team)
{
    $availableEmployees = Employee::all(); // Assuming this is how you get the available employees
    return view('hr.teams_show', compact('team', 'availableEmployees'));
}

public function editteams(Team $team)
{
    $employees = Employee::all();
    return view('hr.teams_edit', compact('team', 'employees'));
}


public function updateteams(Request $request, Team $team)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'team_leader_id' => 'required|exists:employees,id',
        'description' => 'nullable|string',
    ]);

    $team->update($validated);
    return redirect()->route('teamsh.index')->with('success', 'Team updated successfully.');
}

public function destroyteams(Team $team)
{
    $team->delete();
    return redirect()->route('teamsh.index')->with('success', 'Team deleted successfully.');
}
public function addEmployees(Request $request)
{
    $validated = $request->validate([
        'team_id' => 'required|exists:teams,id',
        'employee_ids' => 'required|array',
        'employee_ids.*' => 'exists:employees,id',
    ]);

    $team = Team::findOrFail($validated['team_id']);
    $employeeIds = $validated['employee_ids'];

    // Sync employees with the team
    $team->employees()->syncWithoutDetaching($employeeIds);

    return redirect()->back()->with('success', 'Employees added to the team.');
}



public function removeEmployee(Team $team, Employee $employee)
{
    // Detach the employee from the team
    $team->employees()->detach($employee->id);

    // Redirect or return a response
    return redirect()->back()->with('status', 'Employee removed successfully.');
}

public function getEmployeesByTeam(Team $team)
{
    $employees = $team->employees()->get(['id', 'first_name', 'last_name']);
    return response()->json(['employees' => $employees]);
}


public function showTask()
{
    // Get the authenticated user
    $user = auth()->user();

    // Check if the user is authenticated
    if (!$user) {
        abort(403, 'Unauthorized action: User not authenticated.');
    }

    // Get the employee associated with the authenticated user
    $employee = $user->employee; // Ensure your User model has a relationship to Employee

    // Check if the employee exists
    if (!$employee) {
        abort(404, 'Employee not found.');
    }

    // Retrieve all tasks related to this employee
    $tasks = $employee->tasks; // This will retrieve all tasks for the employee

    // Pass the tasks and employee data to the view
    return view('hr.task_show', compact('tasks', 'employee'));
}


public function updateStatus(Request $request, Task $task)
{
    // Check if the authenticated user is assigned to this task
    if ($task->employee_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Validate the request
    $request->validate([
        'status' => 'required|in:Pending,In Progress,Completed',
    ]);

    // Update the task's status
    $task->status = $request->status;
    $task->save();

    // Redirect back to the task page with success message
    return redirect()->route('tasksh.index', $task->id)->with('success', 'Task status updated successfully.');
}





public function report()
{
    $employees = Employee::with('dailyInOuts')->get();
    $monthlyData = [];

    foreach ($employees as $employee) {
        // Calculate total hours worked in the month
        $totalHours = $employee->dailyInOuts->sum(function ($record) {
            return $record->workedHours();
        });

        // Calculate salary per hour
        $salaryPerHour = $employee->salary / 160; // Assuming 160 hours in a month
        $totalSalary = $totalHours * $salaryPerHour;

        // Deduct 7.5% from the total salary
        $deductionPercentage = 7.25;
        $deductionAmount = ($employee->salary * $deductionPercentage) / 100;

        $adjustedSalary = $totalSalary - $deductionAmount;



        $finalSalary = $adjustedSalary ;

        $monthlyData[] = [
            'name' => $employee->first_name,
            'namel' => $employee->last_name,
            'department' => $employee->department->name ?? 'N/A',
            'total_hours' => $totalHours,
            'salary_per_hour' => $salaryPerHour,
            'total_salary' => $totalSalary,
            'deduction_amount' => $deductionAmount,
            'adjusted_salary' => $adjustedSalary,
            'final_salary' => $finalSalary,
        ];
    }

    return view('hr.reports', compact('monthlyData'));
}




public function indexr()
{
    $leaveRequests = LeaveRequest::with('employee.user')->get();
    return view('hr.leave_requests', compact('leaveRequests'));
}


 // Show the form for creating a new leave request
 public function creater()
 {
     $employees = Employee::all();
     return view('hr.leave_requestsc', compact('employees'));
 }

 // Store a newly created leave request in the database
 public function storer(Request $request)
 {
     $validatedData = $request->validate([
         'employee_id' => 'required|exists:employees,id',
         'leave_type' => 'required|in:Sick,Vacation,Maternity,Paternity,Unpaid',
         'start_date' => 'required|date',
         'end_date' => 'nullable|date|after_or_equal:start_date',
         'status' => 'required|in:Pending,Approved,Rejected',
     ]);

     LeaveRequest::create($validatedData);

     return redirect()->route('hr.leave_requestsi')->with('success', 'Leave request created successfully.');
 }

 // Show the form for editing a specific leave request
 public function editr(LeaveRequest $leaveRequest)

{
    $employees = Employee::all(); // Fetch all employees

    // Check if leave request and employee exists

    dd($leaveRequest);

    return view('hr.leave_requestse', compact('leaveRequest', 'employees'));
}


 // Update the leave request in the database
 public function updater(Request $request, LeaveRequest $leaveRequest)
 {
     $validatedData = $request->validate([
         'employee_id' => 'required|exists:employees,id',
         'leave_type' => 'required|in:Sick,Vacation,Maternity,Paternity,Unpaid',
         'start_date' => 'required|date',
         'end_date' => 'nullable|date|after_or_equal:start_date',
         'status' => 'required|in:Pending,Approved,Rejected',
     ]);

     $leaveRequest->update($validatedData);

     return redirect()->route('hr.leave_requestsi')->with('success', 'Leave request updated successfully.');
 }

 // Delete a specific leave request
 public function destroyr(LeaveRequest $leaveRequest)
 {
     $leaveRequest->delete();

     return redirect()->route('hr.leave_requestsi')->with('success', 'Leave request deleted successfully.');
 }


 public function updateStatusr(Request $request, $id)
 {
     $request->validate([
         'status' => 'required|string|in:Pending,Approved,Rejected',
     ]);

     $leaveRequest = LeaveRequest::findOrFail($id);
     $oldStatus = $leaveRequest->status;

     // Update the status of the leave request
     $leaveRequest->status = $request->status;

     // Only deduct leaves if the status is changed to "Approved" from another status
     if ($request->status == 'Approved' && $oldStatus !== 'Approved') {
         // Convert start_date and end_date to Carbon instances
         $startDate = Carbon::parse($leaveRequest->start_date);
         $endDate = Carbon::parse($leaveRequest->end_date ?? now());

         // Calculate leave days (inclusive)
         $leaveDays = $startDate->diffInDays($endDate) + 1;

         // Deduct sick leave or vacation days based on leave type
         if ($leaveRequest->leave_type == 'Sick') {
             $leaveRequest->employee->sick_leaves -= $leaveDays;
             $leaveRequest->employee->sick_leaves = max(0, $leaveRequest->employee->sick_leaves); // Ensure non-negative
         } elseif ($leaveRequest->leave_type == 'Vacation') {
             $leaveRequest->employee->annual_vacation_days -= $leaveDays;
             $leaveRequest->employee->annual_vacation_days = max(0, $leaveRequest->employee->annual_vacation_days); // Ensure non-negative
         }

         // Save the employee's updated leave balances
         $leaveRequest->employee->save();
     }

     // Save the leave request status
     $leaveRequest->save();

     return redirect()->back()->with('success', 'Leave request status updated successfully!');
 }

 public function JobRequest()
 {
     // Retrieve all job requests with related job offers and users
     $jobRequests = JobRequest::with(['jobOffer', 'user'])->get();

     // Return the view with job requests data
     return view('hr.job_requests', compact('jobRequests'));
 }

}





