<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\Employee;
use App\Models\Erequest;
use App\Models\Position;
use App\Models\DailyInOut;
use App\Models\Department;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Models\EmployeeRelation;


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







        public function indexreq()
        {
            $requests = Erequest::with('employee')->get();
            return view('admin.requests', compact('requests'));
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

    return redirect()->route('requests.index')->with('success', 'Request status updated successfully.');
}

        // Delete request
        public function destroyreq(Erequest $erequest)
        {
            $erequest->delete();
            return redirect()->route('requests.index')->with('success', 'Request deleted successfully.');
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


 $employeeId = auth()->user()->employee->id;

 $latestCheckIn = DailyInOut::where('employee_id', $employeeId)
                             ->orderBy('check_in', 'desc')
                             ->first();

 // Determine if the user can check in or check out
 $canCheckIn = is_null($latestCheckIn) || $latestCheckIn->check_out;
 $canCheckOut = !$canCheckIn && now()->diffInHours($latestCheckIn->check_in) >= 9;
    $employees = Employee::with(['department', 'position', 'user', 'user.role', 'teams'])->paginate(20);
    $roles = Role::all();
    $departments = Department::all();
    $positions = Position::all();
    $teams = Team::all();

    return view('hr.home_hr', compact('latestCheckIn', 'canCheckIn', 'canCheckOut','employees','employees', 'roles', 'departments', 'positions', 'teams'));
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
    return view('hr.employees_addh', compact('employees', 'users', 'roles', 'departments', 'positions', 'teams'));
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






    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $user = $employee->user;
        $roles = Role::all();
        $departments = Department::all();
        $positions = Position::all();
        $teams = Team::all();

        return view('admin.employees_edit', compact('employee', 'user', 'roles', 'departments', 'positions', 'teams'));
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
        'hire_date' => 'nullable|date',
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

    return view('admin.reports', compact('monthlyData'));
}

}
