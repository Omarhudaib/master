<?php

namespace App\Http\Controllers;
use App\Models\DailyInOut;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeRelation;
use App\Models\Erequest;
use App\Models\LeaveRequest;
use App\Models\Meeting;
use App\Models\Message;
use App\Models\Position;
use App\Models\Post;
use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\Location;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;



class AdminController extends Controller
{



    public function indexDepartment()
    {
        // Get all departments
        $departments = Department::all();

        // Return the view with departments data
        return view('admin.department', compact('departments'));
    }

    // Method to create a new department
    public function createDepartment(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Create the department
        $department = Department::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Create the department location
        $department->location()->create([
            'name' => $request->location_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirect back with success message
        return redirect()->route('departments.index')->with('success', 'Department and location created successfully.');
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
            // Fetch totals for the dashboard
            $totalEmployees = Employee::count();
            $totalProjects = Project::count();
            $totalTasks = Task::count();
            $totalDepartments = Department::count();
            $totalLeaveRequests = LeaveRequest::count();
            $totalCheckIns = DailyInOut::whereNotNull('check_in')->count(); // Count only the records with a check-in
            $pendingTasks = Task::where('status', 'Pending')->count(); // Count only the pending tasks
            $pendingTicket = Ticket::where('status', 'Pending')->count();
            // Fetch the authenticated employee ID
            $employeeId = auth()->user()->employee->id;
            $employee = auth()->user()->employee;
            // Get the latest check-in record
            $latestCheckIn = DailyInOut::where('employee_id', $employeeId)
                                        ->orderBy('check_in', 'desc')
                                        ->first();
                                        $pos = Position::find($employee->position_id);  // Get the position name  // Get the position name
                                        $deb = Department::find($employee->department_id);  // Get the department name

                                        // Get the first team associated with the employee
                                        $team = $employee->teams()->first();
                                        $team_leader = $team ? $team->teamLeader : null;
            // Determine if the user can check in or check out
            $canCheckIn = is_null($latestCheckIn) || $latestCheckIn->check_out;
            $canCheckOut = !$canCheckIn && now()->diffInHours($latestCheckIn->check_in) >= 9;

            // Fetch data with pagination
            $employees = Employee::paginate(20);
            $tasks = Task::paginate(20);
            $departments = Department::paginate(20);
            $positions = Position::paginate(20);
            $leaveRequests = LeaveRequest::paginate(20);
            $dailyInOuts = DailyInOut::paginate(20);
            $teams = Team::with(['leader', 'projects', 'employees'])->get();

            // Fetch active projects (for example, those not completed)
            $plannedProjects = Project::where('status', 'Planned')->count(); // Adjust the condition as per your logic
            $activeProjects = Project::where('status', 'In Progress')->count();
            $doneProjects = Project::where('status', 'Completed')->count();
            // Fetch the latest posts
            $posts = Post::latest()->paginate(5); // Fetch the latest 5 posts
            $meetings = Meeting::where('meeting_date', '>', now())->count();
            // Pass totals and other necessary data to the view
            return view('admin.home_admin', compact(
                'latestCheckIn',
                'canCheckIn',
                'canCheckOut',
                'employees',
                'doneProjects',
                'plannedProjects',
                'pendingTicket',
                'tasks',
                'teams',
                'departments',
                'positions',
                'leaveRequests',
                'dailyInOuts',
                'totalEmployees',
                'totalProjects',
                'totalTasks',
                'totalDepartments',
                'totalLeaveRequests',
                'totalCheckIns',
                'activeProjects',
                'pendingTasks',
                'posts',
                'meetings', 'pos' ,'team_leader','deb'
                 // Add posts to the data being passed to the view
            ));
        }


        public function indexpost()
        {
            $posts = Post::with('user')->paginate(10);
            return view('admin.posts', compact('posts'));
        }
        public function indexposts()
        {
            $posts = Post::with('user')->paginate(10);
            $messages = Post::with('user')->paginate(10); // Fetch the messages
            return view('admin.postsall', compact('posts', 'messages')); // Pass both posts and messages
        }


        public function createpost()
        {
            return view('admin.posts_create');
        }

        public function storepost(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            Post::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        }

        public function editpost(Post $post)
        {
            return view('admin.posts_edit', compact('post'));
        }

        public function updatepost(Request $request, Post $post)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
        }
        public function showpost(Post $post)
        {
            return view('admin.posts_show', compact('post'));
        }
        public function destroypost(Post $post)
        {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        }


        public function showall(Request $request)
        {
            $query = Employee::with(['department', 'position', 'user', 'user.role', 'teams']);

            // Search by name or email
            if ($request->filled('search')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');
                });
            }

            // Filter by department
            if ($request->filled('department_id')) {
                $query->where('department_id', $request->department_id);
            }

            // Filter by position
            if ($request->filled('position_id')) {
                $query->where('position_id', $request->position_id);
            }

            // Pagination
            $employees = $query->paginate(20);
            $roles = Role::all();
            $departments = Department::all();
            $positions = Position::all();
            $teams = Team::all();

            return view('admin.employees', compact('employees', 'roles', 'departments', 'positions', 'teams'));
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
    return view('admin.employees_add', compact('employees', 'users', 'roles', 'departments', 'positions', 'teams'));
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

    return redirect()->route('employees')->with('success', 'Employee created successfully.');
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
    return view('admin.employees_show', compact('employee'));
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

    return redirect()->route('employees')->with('success', 'Employee updated successfully.');
}

public function destroy($id)
{
    $employee = Employee::findOrFail($id);
    $employee->delete();

    return redirect()->route('employees')->with('success', 'Employee deleted successfully');
}






//project fun
// ProjectController.php


public function storeproject(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'status' => 'required|in:Planned,In Progress,Completed',
        'team_id' => 'required|exists:teams,id',
    ]);

    Project::create($validated);
    return redirect()->route('projects.index')->with('success', 'Project created successfully.');
}


public function indexproject()
{
    $projects = Project::with('team')->get(); // Fetch all projects with their associated teams
    return view('admin.projects', compact('projects'));
}

public function editproject($id)
{
    $project = Project::findOrFail($id);
    $teams = Team::all(); // Assuming you have a Team model to fetch all teams
    return view('admin.projects_edit', compact('project', 'teams'));
}
public function createproject()
{
    $teams = Team::all(); // Assuming you have a Team model to fetch all teams
    return view('admin.projects_create', compact('teams'));
}
public function updateProject(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'status' => 'required|in:Planned,In Progress,Completed',
        'team_id' => 'required|exists:teams,id',
    ]);

    $project = Project::findOrFail($id);
    $project->update($validated);

    return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
}
public function destroyproject($id)
{
    $project = Project::findOrFail($id);
    $project->delete();
    return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
}


public function indexteams()
{
    $teams = Team::with('employees')->get();
    $assignedEmployeeIds = Employee::whereHas('teams')->pluck('id')->toArray(); // Get IDs of assigned employees
    $availableEmployees = Employee::whereNotIn('id', $assignedEmployeeIds)->get(); // Get employees not in a team
    return view('admin.teams', compact('teams', 'availableEmployees'));
}


public function createteams()
{
    $departments = Department::all();
    $employees = Employee::all();
    return view('admin.teams_create', compact('employees', 'departments'));
}




public function showteams(Team $team)
{
    $availableEmployees = Employee::all(); // Assuming this is how you get the available employees
    return view('admin.teams_show', compact('team', 'availableEmployees'));
}

public function editteams(Team $team)
{   $departments=Department::all();
    $employees = Employee::all();
    return view('admin.teams_edit', compact('team', 'employees','departments'));
}

public function storeteams(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'team_leader_id' => 'required|exists:employees,id',
        'department_id' => 'required|exists:departments,id', // Change 'department' to 'departments'
        'description' => 'nullable|string',
    ]);

    Team::create($validated);
    return redirect()->route('teams.index')->with('success', 'Team created successfully.');
}

public function updateteams(Request $request, Team $team)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'team_leader_id' => 'required|exists:employees,id',
        'department_id' => 'required|exists:departments,id', // Change 'department' to 'departments'
        'description' => 'nullable|string',
    ]);

    $team->update($validated);
    return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
}


public function destroyteams(Team $team)
{
    $team->delete();
    return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
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

public function listTasks()
{

    $tasks = Task::with('project', 'employee', 'team')->get();
    return view('admin.task', compact('tasks'));
}

    public function fetchEmployees($projectId)
        {
            $project = Project::find($projectId);
            $teamId = $project->team_id;

            // Get employees related to the team
            $employees = Employee::where('team_id', $teamId)->get();

            return response()->json(['employees' => $employees]);
        }





        // Show form to create a task
        public function showCreateForm()
        {
            $teams = Team::all();
            $projects = Project::all();
            $employees = Employee::all();
            return view('admin.task_create', compact('teams', 'projects', 'employees'));
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


            Task::create($request->all());

            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        }

        public function showTask(Task $task)
        {
            return view('admin.task_show', compact('task'));
        }

        // Show form to edit a task
        public function showEditForm(Task $task)
        {
            $teams = Team::all();
            $projects = Project::all();
            $employees = Employee::all();
            return view('admin.task_edit', compact('task', 'teams', 'projects', 'employees'));
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
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        }

        // Delete a task
        public function deleteTask(Task $task)
        {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        }

        public function getTeamEmployees($team_id)
        {
            $team = Team::findOrFail($team_id);
            $employees = $team->employees()->get(['id', 'first_name', 'last_name']);

            return response()->json(['employees' => $employees]);
        }

















        public function indexMeeting()
{
    $meetings = Meeting::with(['organizer', 'manager'])->get();
    return view('admin.meetings', compact('meetings'));
}
        public function createMeeting()
        {
            $employees = Employee::all(); // Retrieve all employees
            return view('admin.meetings_add', compact('employees'));
        }

        public function storeMeeting(Request $request)
        {
            $request->validate([
                'subject' => 'required|string|max:255',
                'meeting_date' => 'required|date',
                'location' => 'nullable|string|max:255',
                'organizer_id' => 'required|exists:employees,id',
                'manager_id' => 'nullable|exists:employees,id',
            ]);


            Meeting::create([
                'subject' => $request->input('subject'),
                'meeting_date' => $request->input('meeting_date'),
                'location' => $request->input('location'),
                'organizer_id' => $request->input('organizer_id'),
                'manager_id' => $request->input('manager_id'),
            ]);

            return redirect()->route('meetings.index');
        }
        public function editMeeting($id)
        {
            $meeting = Meeting::findOrFail($id);
            $employees = Employee::all(); // Fetch all employees

            return view('admin.meetings_edit', compact('meeting', 'employees'));
        }


        public function showMeeting(Meeting $meeting)
        {
            return view('admin.meetings_show', compact('meeting'));
        }



        public function updateMeeting(Request $request, Meeting $meeting)
        {
            $request->validate([
                'subject' => 'required|string|max:255',
                'meeting_date' => 'required|date',
                'location' => 'nullable|string|max:255',
                'organizer_id' => 'required|exists:employees,id',
                'manager_id' => 'nullable|exists:employees,id',
            ]);

            $meeting->update($request->all());
            return redirect()->route('meetings.index');
        }

        public function destroMeeting(Meeting $meeting)
        {
            $meeting->delete();
            return redirect()->route('meetings.index');
        }



        public function showRelations($employeeId)
        {
            // Get the employee
            $employee = Employee::with('relatedEmployees')->findOrFail($employeeId);

            // Get all employees to show for potential relations
            $allEmployees = Employee::where('id', '!=', $employeeId)->get();

            // Pass both the employee and the list of all employees to the view
            return view('admin.relations', compact('employee', 'allEmployees'));
        }


        public function addRelation(Request $request, $employeeId)
        {
            $employee = Employee::findOrFail($employeeId);

            // Validate input
            $request->validate([
                'related_employee_id' => 'required|exists:employees,id',
                'relation_type' => 'required|in:Manager,Supervisor,Mentor,Peer',
            ]);

            // Attach the relation
            $employee->relatedEmployees()->attach($request->related_employee_id, ['relation_type' => $request->relation_type]);

            return redirect()->back()->with('success', 'Relation added successfully.');
        }

        public function removeRelation($employeeId, $relatedEmployeeId)
        {
            $employee = Employee::findOrFail($employeeId);
            $employee->relatedEmployees()->detach($relatedEmployeeId);

            return redirect()->back()->with('success', 'Relation removed successfully.');
        }







// Display a listing of the resource.
public function indexPosition()
{
    $positions = Position::with('department')->get();
    return view('admin.positions', compact('positions'));
}

// Show the form for creating a new resource.
public function createPosition()
{
    $departments = Department::all();
    return view('admin.positions_create', compact('departments'));
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

    return redirect()->route('positions.index')->with('success', 'Position created successfully.');
}

// Display the specified resource.
public function showPosition(Position $position)
{
    return view('admin.positions_show', compact('position'));
}

// Show the form for editing the specified resource.
public function editPosition(Position $position)
{
    $departments = Department::all();
    return view('admin.positions_edit', compact('position', 'departments'));
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

    return redirect()->route('positions.index')->with('success', 'Position updated successfully.');
}

// Remove the specified resource from storage.
public function destroyPosition(Position $position)
{
    $position->delete();

    return redirect()->route('positions.index')->with('success', 'Position deleted successfully.');
}




public function editdep($id)
{
    $department = Department::findOrFail($id);
    return view('admin.department_edit', compact('department'));
}
public function updatedepartments(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'location_name' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    // Find the department by ID
    $department = Department::find($id);

    // Check if the department exists
    if (!$department) {
        return redirect()->route('departments.index')->with('error', 'Department not found.');
    }

    // Update department details
    $department->name = $request->input('name');
    $department->description = $request->input('description');

    // Get the associated location (assuming a hasOne or belongsTo relationship)
    $location = $department->location;

    if ($location) {
        // Update existing location
        $location->name = $request->input('location_name');
        $location->latitude = $request->input('latitude');
        $location->longitude = $request->input('longitude');
        $location->save(); // Save the location instance
    } else {
        // Create a new location if none exists
        $newLocation = new Location();
        $newLocation->name = $request->input('location_name');
        $newLocation->latitude = $request->input('latitude');
        $newLocation->longitude = $request->input('longitude');
        $newLocation->department_id = $department->id; // Link the new location to the department
        $newLocation->save(); // Save the new location instance
    }

    // Save the updated department instance
    $department->save();

    // Redirect back with a success message
    return redirect()->route('departments.index')->with('success', 'Department updated successfully');
}









// AdminController.php

public function indexTicket()
{
    $tickets = Ticket::with('employee')->get();
    return view('admin.tickets', compact('tickets'));
}

public function createTicket()
{
    $employees = Employee::all();
    return view('admin.tickets_create', compact('employees'));
}

public function storeTicket(Request $request)
{
    $data = $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'subject' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:Open,In Progress,Closed',
    ]);

    Ticket::create($data);

    return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
}

public function editTicket(Ticket $ticket)
{
    $employees = Employee::all();
    return view('admin.tickets_edit', compact('ticket', 'employees'));
}

public function updateTicket(Request $request, Ticket $ticket)
{
    $data = $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'subject' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:Open,In Progress,Closed',
    ]);

    $ticket->update($data);

    return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
}

public function destroyTicket(Ticket $ticket)
{
    $ticket->delete();
    return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
}

public function checkIn(Request $request)
{
    $employee = Auth::user()->employee;

    // استرجاع المواقع المرتبطة بقسم الموظف
    $locations = Location::where('department_id', $employee->department_id)->get();

    // تحقق مما إذا كان هناك مواقع متاحة
    if ($locations->isEmpty()) {
        return redirect()->back()->withErrors('No locations found for your department.');
    }

    // استرجاع الموقع المتوقع
    $expectedLocation = $locations->first();

    // تقسيم الإحداثيات المدخلة
    $submittedLocation = $request->input('location_in');

    if (strpos($submittedLocation, ',') === false) {
        return redirect()->back()->withErrors(['location_in' => 'Location format is invalid. Please provide latitude and longitude.']);
    }

    list($latitude, $longitude) = explode(',', $submittedLocation);

    // حساب المسافة بين الموقع المدخل والموقع المتوقع
    $distance = $this->haversineGreatCircleDistance(
        (float) $expectedLocation->latitude,
        (float) $expectedLocation->longitude,
        (float) $latitude,
        (float) $longitude
    );

    // تحديد مدى القرب (مثلاً 100 متر)
    $acceptableDistance = 3; // 100 متر في كيلومترات (0.1 كيلومتر)

    if ($distance > $acceptableDistance) {
        return redirect()->back()->withErrors([
            'location_in' => 'The selected location is too far from the expected location: ' . $expectedLocation->name .
                             ' (Distance: ' . round($distance, 2) . ' km, Acceptable: ' . $acceptableDistance . ' km)'
        ]);
    }

    // تحقق مما إذا كان الموظف قد قام بالتسجيل في اليوم نفسه
    $today = now()->format('Y-m-d'); // التاريخ الحالي
    $existingCheckIn = DailyInOut::where('employee_id', $employee->id)
                                   ->whereDate('check_in', $today)
                                   ->first();

    if ($existingCheckIn) {
        return redirect()->back()->withErrors('You have already checked in today.');
    }

    // إنشاء سجل جديد في نموذج DailyInOut
    DailyInOut::create([
        'employee_id' => $employee->id,
        'check_in' => now(),
        'location_in' => $submittedLocation, // تخزين الموقع المدخل
    ]);

    return redirect()->back()->with('success', 'You have checked in.');
}


// دالة لحساب المسافة بين نقطتين باستخدام معادلة هافرسين
private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
{
    // تحويل الدرجات إلى راديان
    $latitudeFrom = deg2rad($latitudeFrom);
    $longitudeFrom = deg2rad($longitudeFrom);
    $latitudeTo = deg2rad($latitudeTo);
    $longitudeTo = deg2rad($longitudeTo);

    // فرق الإحداثيات
    $latDifference = $latitudeTo - $latitudeFrom;
    $lonDifference = $longitudeTo - $longitudeFrom;

    // حساب المسافة باستخدام صيغة هافرسين
    $a = sin($latDifference / 2) * sin($latDifference / 2) +
         cos($latitudeFrom) * cos($latitudeTo) *
         sin($lonDifference / 2) * sin($lonDifference / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $earthRadius * $c; // المسافة بالكيلومترات
}



public function checkOut(Request $request)
{
    $employee = Auth::user()->employee;

    // استرجاع المواقع المرتبطة بقسم الموظف
    $locations = Location::where('department_id', $employee->department_id)->get();

    // تحقق مما إذا كان هناك مواقع متاحة
    if ($locations->isEmpty()) {
        return redirect()->back()->withErrors('No locations found for your department.');
    }

    // استرجاع الموقع المتوقع
    $expectedLocation = $locations->first();

    // تقسيم الإحداثيات المدخلة
    $submittedLocation = $request->input('location_out');

    if (strpos($submittedLocation, ',') === false) {
        return redirect()->back()->withErrors(['location_out' => 'Location format is invalid. Please provide latitude and longitude.']);
    }

    list($latitude, $longitude) = explode(',', $submittedLocation);

    // حساب المسافة بين الموقع المدخل والموقع المتوقع
    $distance = $this->haversineGreatCircleDistance(
        (float) $expectedLocation->latitude,
        (float) $expectedLocation->longitude,
        (float) $latitude,
        (float) $longitude
    );
    $today = now()->format('Y-m-d'); // التاريخ الحالي
    $existingCheckOut= DailyInOut::where('employee_id', $employee->id)
                                   ->whereDate('check_out', $today)
                                   ->first();

    if ($existingCheckOut) {
        return redirect()->back()->withErrors('You have already checked out in today.');
    }

    // تحديد مدى القرب (مثلاً 100 متر)
    $acceptableDistance = 3; // 100 متر في كيلومترات (0.1 كيلومتر)

    if ($distance > $acceptableDistance) {
        return redirect()->back()->withErrors([
            'location_out' => 'The selected location is too far from the expected location: ' . $expectedLocation->name .
                              ' (Distance: ' . round($distance, 2) . ' km, Acceptable: ' . $acceptableDistance . ' km)'
        ]);
    }

    // استرجاع أحدث تسجيل دخول للموظف
    $latestCheckIn = DailyInOut::where('employee_id', $employee->id)
                                ->whereNull('check_out')
                                ->orderBy('check_in', 'desc')
                                ->first();

    if ($latestCheckIn) {
        $latestCheckIn->update([
            'check_out' => now(),
            'location_out' => $submittedLocation, // حفظ الموقع عند تسجيل الخروج
        ]);
    }


    return redirect()->back()->with('success', 'You have checked out.');
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
