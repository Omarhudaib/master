<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HrController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
// Admin route


// Employee route
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');

// HR route
Route::get('/hr', [HrController::class, 'index'])->name('employeesh'); // Or whatever route name you need




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// In your web.php
Route::post('/day-action', [EmployeeController::class, 'handleDayAction'])->name('day-action');


Route::get('chate/{employeeId}', [EmployeeController::class, 'indexe'])->name('chate.index');


Route::get('chate/{user}', [EmployeeController::class, 'showe'])->name('chate.show');
Route::post('chate/send', [EmployeeController::class, 'sende'])->name('chate.send');

Route::get('/employee', [EmployeeController::class, 'indexEmployee'])->name('employee');
Route::get('/ticket_list', [EmployeeController::class, 'ticketEmployee'])->name('ticket_list');
Route::get('/',function() {
    return view('home');});
// web.php
 // Make sure this import is correct
// Route for updating task status
Route::patch('/tasks/{id}/update', [EmployeeController::class, 'updateStatusta'])->name('updateTask');

// Route for updating ticket status
Route::patch('/tickets/{id}/update', [EmployeeController::class, 'updateStatusti'])->name('updateTicket');


// web.php

Route::get('employee_p/{id}/edit', [EmployeeController::class, 'edit'])->name('employee_p.edit');
Route::put('employee_p/{id}', [EmployeeController::class, 'update'])->name('employee_p.update');










//::get('/chat/{employeeId}', [ChatController::class, 'index'])->name('chat.index');


//::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
//Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');


















Route::get('/employees', [AdminController::class, 'showall'])->name('employees');
Route::get('/employees_add', [AdminController::class, 'showemployee'])->name('employees_add');

Route::get('/employees/{id}', [AdminController::class, 'show'])->name('employees.show');
Route::get('/employees/{id}/edit', [AdminController::class, 'edit'])->name('employees.edit');
Route::post('/employees', [AdminController::class, 'store'])->name('employees.store');
Route::put('/employees/{id}', [AdminController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [AdminController::class, 'destroy'])->name('employees.destroy');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Team Routes
Route::get('teams', [AdminController::class, 'indexteams'])->name('teams.index');
Route::get('teams/create', [AdminController::class, 'createteams'])->name('teams.create');
Route::post('teams', [AdminController::class, 'storeteams'])->name('teams.store');
Route::get('teams/{team}', [AdminController::class, 'showteams'])->name('teams.show');
Route::get('teams/{team}/edit', [AdminController::class, 'editteams'])->name('teams.edit');
Route::put('teams/{team}', [AdminController::class, 'updateteams'])->name('teams.update');
Route::delete('teams/{team}', [AdminController::class, 'destroyteams'])->name('teams.destroy');

// Add Employees to a Team
Route::post('/teams/add-employees', [AdminController::class, 'addEmployees'])->name('teams.addEmployees');

// Remove Employee from a Team
Route::delete('teams/{team}/employees/{employee}', [AdminController::class, 'removeEmployee'])->name('teams.removeEmployee');

// Get Employees by Team
Route::get('teams/{team}/employees', [AdminController::class, 'getEmployeesByTeam'])->name('teams.getTeamEmployees');
// Remove Employee from a Team
Route::delete('teams/{team}/employees/{employee}', [AdminController::class, 'removeEmployee'])->name('teams.removeEmployee');




Route::get('projects', [AdminController::class, 'indexproject'])->name('projects.index');
Route::get('projects/create', [AdminController::class, 'createproject'])->name('projects.create');
Route::post('projects', [AdminController::class, 'storeproject'])->name('projects.store');
Route::get('projects/{project}/edit', [AdminController::class, 'editproject'])->name('projects.edit');
Route::put('projects/{project}', [AdminController::class, 'updateproject'])->name('projects.update');
Route::delete('projects/{project}', [AdminController::class, 'destroyproject'])->name('projects.destroy');

//Route::middleware(['auth', 'admin'])->group(function () {
 //   Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    // Add more routes for admin actions as needed
//});
Route::prefix('tasks')->group(function () {
    Route::get('/', [AdminController::class, 'listTasks'])->name('tasks.index');
    Route::get('create', [AdminController::class, 'showCreateForm'])->name('tasks.create');
    Route::post('store', [AdminController::class, 'storeTask'])->name('tasks.store');
    Route::get('{task}', [AdminController::class, 'showTask'])->name('tasks.show');
    Route::get('{task}/edit', [AdminController::class, 'showEditForm'])->name('tasks.edit');
    Route::put('{task}', [AdminController::class, 'updateTask'])->name('tasks.update');
    Route::delete('{task}', [AdminController::class, 'deleteTask'])->name('tasks.delete');
});
Route::get('fetch-employees/{projectId}', [AdminController::class, 'fetchEmployees']);



// Display requests
Route::get('/requests', [AdminController::class, 'indexreq'])->name('requests.index');

// Update request status
Route::post('/requests/{request}/update', [AdminController::class, 'updateStatusreq'])->name('requests.updateStatus');

// Delete request
Route::delete('/requests/{request}', [AdminController::class, 'destroyreq'])->name('requests.destroy');


Route::get('/departments', [AdminController::class, 'indexDepartment'])->name('departments.index');
Route::post('/departments', [AdminController::class, 'createDepartment'])->name('departments.create');






// Route for displaying all meetings
Route::get('/meetings', [AdminController::class, 'indexMeeting'])->name('meetings.index');

// Route for showing the form to create a new meeting
Route::get('/meetings/create', [AdminController::class, 'createMeeting'])->name('meetings.create');

// Route for storing a new meeting
Route::post('/meetings', [AdminController::class, 'storeMeeting'])->name('meetings.store');

// Route for showing a single meeting
Route::get('/meetings/{meeting}', [AdminController::class, 'showMeeting'])->name('meetings.show');

// Route for showing the form to edit a meeting
Route::get('/meetings/{meeting}/edit', [AdminController::class, 'editMeeting'])->name('meetings.edit');

// Route for updating a meeting
Route::put('/meetings/{meeting}', [AdminController::class, 'updateMeetingMeeting'])->name('meetings.update');

// Route for deleting a meeting
Route::delete('/meetings/{meeting}', [AdminController::class, 'destroMeeting'])->name('meetings.destroy');




Route::get('/report', [AdminController::class, 'report'])->name('report');


Route::post('/daily_in_out/check-in', [AdminController::class, 'checkIn'])->name('daily_in_out.checkIn');
Route::post('/daily_in_out/check-out', [AdminController::class, 'checkOut'])->name('daily_in_out.checkOut');



Route::prefix('positions')->group(function () {
    Route::get('/', [AdminController::class, 'indexPosition'])->name('positions.index');
    Route::get('/create', [AdminController::class, 'createPosition'])->name('positions.create');
    Route::post('/', [AdminController::class, 'storePosition'])->name('positions.store');
    Route::get('/{position}', [AdminController::class, 'showPosition'])->name('positions.show');
    Route::get('/{position}/edit', [AdminController::class, 'editPosition'])->name('positions.edit');
    Route::put('/{position}', [AdminController::class, 'updatePosition'])->name('positions.update');
    Route::delete('/{position}', [AdminController::class, 'destroyPosition'])->name('positions.destroy');
});






Route::get('/tickets', [AdminController::class, 'indexTicket'])->name('tickets.index');
Route::get('/tickets/create', [AdminController::class, 'createTicket'])->name('tickets.create');
Route::post('/tickets', [AdminController::class, 'storeTicket'])->name('tickets.store');
Route::get('/tickets/{ticket}/edit', [AdminController::class, 'editTicket'])->name('tickets.edit');
Route::put('/tickets/{ticket}', [AdminController::class, 'updateTicket'])->name('tickets.update');
Route::delete('/tickets/{ticket}', [AdminController::class, 'destroyTicket'])->name('tickets.destroy');





//hr

Route::get('/home_hr', [HrController::class, 'index'])->name('employeesh');
Route::get('/employeesh', [HrController::class, 'showall'])->name('employeesh');
Route::get('/employees_addh', [HrController::class, 'showemployee'])->name('employees_addh');

Route::get('/employeesh/{id}', [HrController::class, 'show'])->name('employeesh.show');
Route::get('/employeesh/{id}/edit', [HrController::class, 'edith'])->name('employeesh.edit');
Route::post('/employeesh', [HrController::class, 'store'])->name('employeesh.store');
Route::put('/employeesh/{id}', [HrController::class, 'update'])->name('employeesh.update');
Route::delete('/employeesh/{id}', [HrController::class, 'destroy'])->name('employeesh.destroy');




Route::get('/departments', [HrController::class, 'indexDepartment'])->name('departmentsh');
Route::post('/departments', [HrController::class, 'createDepartment'])->name('departments.create');



Route::prefix('positions')->group(function () {
    Route::get('/', [HrController::class, 'indexPosition'])->name('positionsh.index');
    Route::get('/create', [HrController::class, 'createPosition'])->name('positionsh.create');
    Route::post('/', [HrController::class, 'storePosition'])->name('positionsh.store');
    Route::get('/{position}', [HrController::class, 'showPosition'])->name('positionsh.show');
    Route::get('/{position}/edit', [HrController::class, 'editPosition'])->name('positionsh.edit');
    Route::put('/{position}', [HrController::class, 'updatePosition'])->name('positionsh.update');
    Route::delete('/{position}', [HrController::class, 'destroyPosition'])->name('positionsh.destroy');
});






Route::get('/chat/{employeeId}', [HrController::class, 'indexm'])->name('chath.index');


Route::get('/chat/{user}', [HrController::class, 'showm'])->name('chath.show');
Route::post('/chat/send', [HrController::class, 'send'])->name('chath.send');

Route::get('/meetings', [HrController::class, 'indexMeeting'])->name('meetingsh.index');




// Display requests
Route::get('/requests', [HrController::class, 'indexreq'])->name('requestsh.index');

// Update request status
Route::post('/requests/{request}/update', [HrController::class, 'updateStatusreq'])->name('requestsh.updateStatus');

// Delete request
Route::delete('/requests/{request}', [HrController::class, 'destroyreq'])->name('requestsh.destroy');
// Team Routes
Route::get('teams', [HrController::class, 'indexteams'])->name('teamsh.index');
Route::get('teams/create', [HrController::class, 'createteams'])->name('teamsh.create');
Route::post('teams', [HrController::class, 'storeteams'])->name('teamsh.store');
Route::get('teams/{team}', [HrController::class, 'showteams'])->name('teamsh.show');
Route::get('teams/{team}/edit', [HrController::class, 'editteams'])->name('teamsh.edit');
Route::put('teams/{team}', [HrController::class, 'updateteams'])->name('teamsh.update');
Route::delete('teams/{team}', [HrController::class, 'destroyteams'])->name('teamsh.destroy');

// Add Employees to a Team
Route::post('/teams/add-employees', [HrController::class, 'addEmployees'])->name('teamsh.addEmployees');

// Remove Employee from a Team
Route::delete('teams/{team}/employees/{employee}', [HrController::class, 'removeEmployee'])->name('teamsh.removeEmployee');

// Get Employees by Team
Route::get('teams/{team}/employees', [HrController::class, 'getEmployeesByTeam'])->name('teamsh.getTeamEmployees');
// Remove Employee from a Team
Route::delete('teams/{team}/employees/{employee}', [HrController::class, 'removeEmployee'])->name('teamsh.removeEmployee');


Route::get('/task', [HrController::class, 'showTask'])->name('tasksh.index');

Route::put('/tasks/{task}/updateStatus', [HrController::class, 'updateStatus'])->name('tasksh.updateStatus');
Route::post('/requests/{request}/update', [HrController::class, 'updateStatusreq'])->name('requestsh.updateStatus');


Route::get('/report', [HrController::class, 'report'])->name('reporth');

Route::get('/attendance', [HrController::class, 'indexa'])->name('attendance.indexx');
Route::get('/attendance/edit/{id}', [HrController::class, 'editat'])->name('attendance.edit');
Route::post('/attendance/update/{id}', [HrController::class, 'updateat'])->name('attendance.update');


Route::post('/start-work-day', [EmployeeController::class, 'startWorkDay'])->name('start-work-day');
Route::put('/leave-requests/{id}/update-status', [HrController::class, 'updateStatusr'])->name('leave_request_update_status');

Route::get('hr/leave_requests', [HrController::class, 'indexr'])->name('hr.leave_requestsi');
Route::get('hr/leave_requests/create', [HrController::class, 'creater'])->name('leave_requestsc');
Route::post('hr/leave_requests', [HrController::class, 'storer'])->name('leave_requestss');
Route::get('hr/leave_requests/{leaveRequest}/edit', [HrController::class, 'editr'])->name('leave_requestse');
Route::put('hr/leave_requests/{leaveRequest}', [HrController::class, 'updater'])->name('leave_requestsu');


Route::delete('hr/leave_requests/{leaveRequest}', [HrController::class, 'destroyr'])->name('leave_requestsd');

// In routes/web.php
Route::get('/job-requests', [HrController::class, 'JobRequest'])->name('job.requests.index');

use App\Http\Controllers\JobOfferController;

Route::resource('job_offers', JobOfferController::class);
Route::get('/career', [JobOfferController::class, 'show'])->name('career');
Route::post('/job/{id}/apply', [JobOfferController::class, 'apply'])->name('job.apply');



