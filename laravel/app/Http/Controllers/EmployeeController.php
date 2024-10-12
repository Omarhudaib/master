<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Position;
use App\Models\DailyInOut;
use App\Models\Department;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
    public function indexEmployee()
{
    // Get the authenticated user's employee ID
    $employeeId = Auth::user()->employee->id;

    // Get teams related to the authenticated employee
    $teams = Team::with(['teamLeader', 'employees'])->get();

    // Get the latest check-in record for the employee
    $latestCheckIn = DailyInOut::where('employee_id', $employeeId)
                                ->orderBy('check_in', 'desc')
                                ->first();

    // Determine if the user can check in or check out
    $canCheckIn = is_null($latestCheckIn) || $latestCheckIn->check_out;
    $canCheckOut = !$canCheckIn && now()->diffInHours($latestCheckIn->check_in) >= 9;

    // Retrieve tasks and tickets related to the authenticated employee
    $tasks = Task::whereHas('employee', function ($query) use ($employeeId) {
        $query->where('user_id', Auth::id());
    })->get();

    $tickets = Ticket::whereHas('employee', function ($query) use ($employeeId) {
        $query->where('user_id', Auth::id());
    })->get();

    // Count leave requests for the employee
    $leaveRequests = LeaveRequest::where('employee_id', $employeeId)->count();

    // Count responded, resolved, and pending tickets
    $responded = $tickets->where('status', 'Responded')->count();
    $resolved = $tickets->where('status', 'Resolved')->count();
    $pending = $tickets->where('status', 'Pending')->count();

    // Count pending, in-progress, and completed tasks
    $pendingTasks = $tasks->where('status', 'Pending')->count();
    $inProgressTasks = $tasks->where('status', 'In Progress')->count();
    $completedTasks = $tasks->where('status', 'Completed')->count();

    // Return the view with the necessary data
    return view('employee.home_employee', compact(
        'teams',
        'leaveRequests',
        'latestCheckIn',
        'canCheckIn',
        'canCheckOut',
        'tasks',
        'tickets',
        'responded',
        'resolved',
        'pending',
        'pendingTasks',
        'inProgressTasks',
        'completedTasks'
    ));
}




// EmployeeController.php
public function edit()
{   $employeeId = auth()->user()->employee->id;
    $employee = Employee::findOrFail($employeeId);
    return view('employee.employee_p', compact('employee'));
}
public function update(Request $request, $id)
{
    // Find the employee
    $employee = Employee::findOrFail($id);

    // Validate the request
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'national_id' => 'required|string|max:255',
        'marital_status' => 'required|string|in:single,married',
        'phone_number' => 'required|string|max:255',
        'employee_identifier' => 'required|string|max:255',


    ]);

    // Update only the allowed fields
    $employee->update([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'date_of_birth' => $request->input('date_of_birth'),
        'national_id' => $request->input('national_id'),
        'marital_status' => $request->input('marital_status'),
        'phone_number' => $request->input('phone_number'),
        'employee_identifier' => $request->input('employee_identifier'),
    ]);

    return redirect()->back()->with('success', 'Employee details updated successfully.');
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
    $employeeId = Auth::id(); // Get the authenticated user's ID

    // Get tasks related to the authenticated user
    $tasks = Task::whereHas('employee', function ($query) use ($employeeId) {
        $query->where('user_id', $employeeId);
    })->with('employee')->get();

    // Get tickets related to the authenticated user
    $tickets = Ticket::whereHas('employee', function ($query) use ($employeeId) {
        $query->where('user_id', $employeeId);
    })->with('employee')->get();
 // Calculate ticket counts
 $totalTickets = $tickets->count();
 $respondedTickets = $tickets->where('status', 'Closed')->count();
 $resolvedTickets = $tickets->where('status', 'In Progress')->count();
 $pendingTickets = $tickets->where('status', 'Open')->count();

 // Calculate task counts
 $totalTask = $tasks->count();
 $responded = $tasks->where('status', 'Pending')->count();
 $resolved = $tasks->where('status',  'In Progress')->count();
 $pending = $tasks->where('status', 'Completed')->count();
    // Return the view with all the necessary data
    return view('employee.ticket_list', compact('tasks','tickets', 'totalTickets', 'respondedTickets', 'resolvedTickets', 'pendingTickets', 'totalTask', 'responded', 'resolved', 'pending'));
}


public function taskEmployee()
{
    $employeeId = Auth::id(); // Get the authenticated user's ID

    // Get tasks related to the authenticated user
    $tasks = Task::whereHas('employee', function ($query) use ($employeeId) {
        $query->where('user_id', $employeeId);
    })->with('employee')->get();

    // Get tickets related to the authenticated user
    $tickets = Ticket::whereHas('employee', function ($query) use ($employeeId) {
        $query->where('user_id', $employeeId);
    })->with('employee')->get();

    // Calculate ticket counts
    $totalTickets = $tickets->count();
    $respondedTickets = $tickets->where('status', 'Closed')->count();
    $resolvedTickets = $tickets->where('status', 'In Progress')->count();
    $pendingTickets = $tickets->where('status', 'Open')->count();

    // Calculate task counts
    $totalTask = $tasks->count();
    $pendingTasks = $tasks->where('status', 'Pending')->count();
    $respondedTasks = $tasks->where('status',  'In Progress')->count();
    $resolvedTasks = $tasks->where('status', 'Completed')->count();

    // Return the view with all the necessary data
    return view('employee.task_list', compact('tasks','tickets', 'totalTask',
     'respondedTickets', 'resolvedTickets',
     'pendingTickets', 'totalTask', 'respondedTasks',
      'resolvedTasks', 'pendingTasks'));
}

// TaskController.php
public function updateStatusta(Request $request, $id)
{
    $task = Task::findOrFail($id);

    $request->validate([
        'status' => 'required|string|in:In Progress,Completed,Pending',
    ]);

    $task->status = $request->input('status');
    $task->save();

    return redirect()->back()->with('success', 'Task status updated successfully.');
}

// TicketController.php
public function updateStatusti(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);



    $ticket->status = $request->input('status');
    $ticket->save();

    return redirect()->back()->with('success', 'Ticket status updated successfully.');
}


 // Store a newly created leave request in the database
 public function storer(Request $request)
 {
     $validatedData = $request->validate([
         'employee_id' => 'required|exists:employees,id',
         'leave_type' => 'required|in:Sick,Vacation,Maternity,Paternity,Unpaid',
         'start_date' => 'required|date',
         'end_date' => 'nullable|date|after_or_equal:start_date',
     ]);

     $validatedData['status'] = 'Pending'; // Set default status

     LeaveRequest::create($validatedData);

     return redirect()->route('leave_requests_index')->with('success', 'Leave request created successfully.');
 }

 public function indexre()
 {
     // Get the authenticated employee's ID
     $employeeId = auth()->id();

     // Retrieve all leave requests for the authenticated employee
     $leaveRequests = LeaveRequest::where('employee_id', $employeeId)->get();

     // Pass the leave requests to the view
     return view('employee.leave_requestsc', compact('leaveRequests'));
 }



public function indexe($employeeId)
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
    return view('employee.chate', compact('employee', 'employees', 'messages'));
}
public function showe($employeeId)
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

    return view('employee.chate', compact('employee', 'employees', 'messages'));
}



public function sende(Request $request)
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

    return redirect()->route('chate.show', $request->receiver_id)->with('success', 'Message sent!');
}



















public function listTasks()
{

    $tasks = Task::with('project', 'employee', 'team')->get();
    return view('employee.task.task', compact('tasks'));
}

    public function fetchEmployees($projectId)
        {
            $project = Project::find($projectId);
            $teamId = $project->team_id;

            // Get employees related to the team
            $employees = Employee::where('team_id', $teamId)->get();

            return response()->json(['employees' => $employees]);
        }
        public function showCreateForm()
        {
            $projects = Project::with('team.employees')->get();  // Retrieve projects with their team and employees
            $user = auth()->user();  // Get the logged-in user

            $team = null;
            $employees = collect();  // Create an empty collection for employees

            // Check if the user is part of a team and retrieve its employees
            if ($user->teams && $user->teams->isNotEmpty()) {
                $team = $user->teams->first();  // Retrieve the first team the user belongs to
                $employees = $team->employees;  // Get all employees of the team
            }

            return view('employee.task.task_create', compact('projects', 'team', 'employees'));
        }





        public function storeTask(Request $request)
        {
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'employee_id' => 'required|exists:employees,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'due_date' => 'nullable|date',
                'status' => 'required|in:Pending,In Progress,Completed',
            ]);
            $project = Project::find($request->project_id);

            // Ensure employee is part of the project's team
            if (!$project->team->employees->contains($request->employee_id)) {
                return back()->withErrors(['employee_id' => 'Selected employee is not part of the project team']);
            }
            Task::create($request->all());

            return redirect()->route('taskse.index')->with('success', 'Task created successfully.');
        }

        public function showTask(Task $task)
        {
            return view('employee.task.task_show', compact('task'));
        }

        // Show form to edit a task
        public function showEditForm(Task $task)
        {
            $teams = Team::all();
            $projects = Project::all();
            $employees = Employee::all();
            return view('employee.task.task_edit', compact('task', 'teams', 'projects', 'employees'));
        }

        // Update a task
        public function updateTask(Request $request, Task $task)
        {
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'employee_id' => 'required|exists:employees,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'due_date' => 'nullable|date',
                'status' => 'required|in:Pending,In Progress,Completed',
                'team_id' => 'required|exists:teams,id',
            ]);

            // Check if the user is a team leader of the selected team
            $user = auth()->user();
            $team = Team::find($request->team_id);
            if (!$team || $team->teamLeader->id !== $user->id) {
                return redirect()->back()->with('error', 'You are not authorized to update tasks for this team.');
            }

            $task->update($request->all());
            return redirect()->route('taskse.index')->with('success', 'Task updated successfully.');
        }

        // Delete a task
        public function deleteTask(Task $task)
        {
            $task->delete();
            return redirect()->route('taskse.index')->with('success', 'Task deleted successfully.');
        }

        public function getTeamEmployees($team_id)
        {
            $team = Team::findOrFail($team_id);
            $employees = $team->employees()->get(['id', 'first_name', 'last_name']);

            return response()->json(['employees' => $employees]);
        }

}
