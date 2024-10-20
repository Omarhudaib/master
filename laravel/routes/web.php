<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HrController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Storage;

Route::get('resumes/{filename}', function ($filename) {
    return response()->download(storage_path('app/resumes/' . $filename));
})->name('resumes.download');

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
Route::get('/logout',function() {
    return view('home');});

// In your web.php
Route::post('/day-action', [EmployeeController::class, 'handleDayAction'])->name('day-action');

Route::get('leave_requestse', [EmployeeController::class,'indexre'])->name('leave_requests_index');

Route::post('/leave_requestse/create', [EmployeeController::class, 'storer'])->name('leave_requests_create');
Route::get('chate/{employeeId}', [EmployeeController::class, 'indexe'])->name('chate.index');


Route::get('chate/{user}', [EmployeeController::class, 'showe'])->name('chate.show');
Route::post('chate/send', [EmployeeController::class, 'sende'])->name('chate.send');

Route::get('/employee', [EmployeeController::class, 'indexEmployee'])->name('employee');
Route::get('/task_list', [EmployeeController::class, 'taskEmployee'])->name('task_list');
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


Route::prefix('tasksem')->group(function () {
    Route::get('/', [EmployeeController::class, 'listTasks'])->name('taskse.index');
    Route::get('create', [EmployeeController::class, 'showCreateForm'])->name('taskse.create');
    Route::post('store', [EmployeeController::class, 'storeTask'])->name('taskse.store');
    Route::get('{task}', [EmployeeController::class, 'showTask'])->name('taskse.show');
    Route::get('{task}/edit', [EmployeeController::class, 'showEditForm'])->name('taskse.edit');
    Route::put('{task}', [EmployeeController::class, 'updateTask'])->name('taskse.update');
    Route::delete('{task}', [EmployeeController::class, 'deleteTask'])->name('taskse.delete');
});


Route::get('/tickete', [EmployeeController::class, 'indexTicket'])->name('ticketse.index');
Route::get('/tickete/create', [EmployeeController::class, 'createTicket'])->name('ticketse.create');
Route::post('/tickete', [EmployeeController::class, 'storeTicket'])->name('ticketse.store');
Route::get('/tickete/{ticket}/edit', [EmployeeController::class, 'editTicket'])->name('ticketse.edit');
Route::put('/tickete/{ticket}', [EmployeeController::class, 'updateTicket'])->name('ticketse.update');
Route::delete('/tickete/{ticket}', [EmployeeController::class, 'destroyTicket'])->name('ticketse.destroy');


Route::get('/postsem', [EmployeeController::class, 'indexposts'])->name('postsem.index');




Route::get('/chatd/{employeeId}', [ChatController::class, 'index'])->name('chat.index');


Route::get('/chatd/{user}', [ChatController::class, 'show'])->name('chat.show');
Route::post('/chatd/send', [ChatController::class, 'send'])->name('chat.send');


















Route::get('/employeesd', [AdminController::class, 'showall'])->name('employees');
Route::get('/employees_addd', [AdminController::class, 'showemployee'])->name('employees_add');

Route::get('/employeesd/{id}', [AdminController::class, 'show'])->name('employees.show');
Route::get('/employeesd/{id}/edit', [AdminController::class, 'edit'])->name('employees.edit');
Route::post('/employeesd', [AdminController::class, 'store'])->name('employees.store');
Route::put('/employeesd/{id}', [AdminController::class, 'update'])->name('employees.update');
Route::delete('/employeesd/{id}', [AdminController::class, 'destroy'])->name('employees.destroy');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Team Routes
Route::get('teamsd', [AdminController::class, 'indexteams'])->name('teams.index');
Route::get('teamsd/create', [AdminController::class, 'createteams'])->name('teams.create');
Route::post('teamsd', [AdminController::class, 'storeteams'])->name('teams.store');
Route::get('teamsd/{team}', [AdminController::class, 'showteams'])->name('teams.show');
Route::get('teamsd/{team}/edit', [AdminController::class, 'editteams'])->name('teams.edit');
Route::put('teamsd/{team}', [AdminController::class, 'updateteams'])->name('teams.update');
Route::delete('teamsd/{team}', [AdminController::class, 'destroyteams'])->name('teams.destroy');

// Add Employees to a Team
Route::post('/teamsd/add-employees', [AdminController::class, 'addEmployees'])->name('teams.addEmployees');

// Remove Employee from a Team
Route::delete('teamsd/{team}/employees/{employee}', [AdminController::class, 'removeEmployee'])->name('teams.removeEmployee');

// Get Employees by Team
Route::get('teamsd/{team}/employees', [AdminController::class, 'getEmployeesByTeam'])->name('teams.getTeamEmployees');
// Remove Employee from a Team
Route::delete('teamsd/{team}/employees/{employee}', [AdminController::class, 'removeEmployee'])->name('teams.removeEmployee');


// Route for showing the edit form for a specific department
Route::get('/departmentsa/{id}/edit', [AdminController::class, 'editdep'])->name('departmentsa.edit');

// Route for updating a specific department
Route::put('/departmentsa/{id}', [AdminController::class, 'updatedepartments'])->name('departmentsa.update');


Route::get('projectsd', [AdminController::class, 'indexproject'])->name('projects.index');
Route::get('projectsd/create', [AdminController::class, 'createproject'])->name('projects.create');
Route::post('projectsd', [AdminController::class, 'storeproject'])->name('projects.store');
Route::get('projectsd/{project}/edit', [AdminController::class, 'editproject'])->name('projects.edit');
Route::put('projectsd/{project}', [AdminController::class, 'updateproject'])->name('projects.update');
Route::delete('projectsdproject}', [AdminController::class, 'destroyproject'])->name('projects.destroy');

//Route::middleware(['auth', 'admin'])->group(function () {
 //   Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    // Add more routes for admin actions as needed
//});
Route::prefix('tasksd')->group(function () {
    Route::get('/', [AdminController::class, 'listTasks'])->name('tasks.index');
    Route::get('create', [AdminController::class, 'showCreateForm'])->name('tasks.create');
    Route::post('store', [AdminController::class, 'storeTask'])->name('tasks.store');
    Route::get('{task}', [AdminController::class, 'showTask'])->name('tasks.show');
    Route::get('{task}/edit', [AdminController::class, 'showEditForm'])->name('tasks.edit');
    Route::put('{task}', [AdminController::class, 'updateTask'])->name('tasks.update');
    Route::delete('{task}', [AdminController::class, 'deleteTask'])->name('tasks.delete');
});
Route::get('fetch-employeesd/{projectId}', [AdminController::class, 'fetchEmployees']);

Route::get('employees/{id}/relations', [AdminController::class, 'showRelations'])->name('employees.relations');
Route::post('employees/{id}/relations', [AdminController::class, 'addRelation'])->name('employees.addRelation');
Route::delete('employees/{employee}/relations/{relatedEmployee}', [AdminController::class, 'removeRelation'])->name('employees.removeRelation');


// Display requests
Route::get('/requestsd', [AdminController::class, 'indexreq'])->name('requests.index');

// Update request status
Route::post('/requestsd/{request}/update', [AdminController::class, 'updateStatusreq'])->name('requests.updateStatus');

// Delete request
Route::delete('/requestsd/{request}', [AdminController::class, 'destroyreq'])->name('requests.destroy');


Route::get('/departmentsd', [AdminController::class, 'indexDepartment'])->name('departments.index');
Route::post('/departmentsd', [AdminController::class, 'createDepartment'])->name('departmentsd.create');

Route::get('/postsall', [AdminController::class, 'indexposts'])->name('postsall.index');

Route::get('/posts', [AdminController::class, 'indexpost'])->name('posts.index');

// Route for displaying the form to create a new post
Route::get('/posts/create', [AdminController::class, 'createpost'])->name('posts.create');

// Route for storing a new post
Route::post('/posts', [AdminController::class, 'storepost'])->name('posts.store');
Route::get('posts/{post}', [AdminController::class, 'showpost'])->name('posts.show');
Route::get('posts/{post}/edit', [AdminController::class, 'editpost'])->name('posts.edit');
Route::put('posts/{post}', [AdminController::class, 'updatepost'])->name('posts.update');
Route::delete('posts/{post}', [AdminController::class, 'destroypost'])->name('posts.destroy');


// Route for displaying all meetings
Route::get('/meetingsd', [AdminController::class, 'indexMeeting'])->name('meetings.index');

// Route for showing the form to create a new meeting
Route::get('/meetingsd/create', [AdminController::class, 'createMeeting'])->name('meetings.create');

// Route for storing a new meeting
Route::post('/meetingsd', [AdminController::class, 'storeMeeting'])->name('meetings.store');

// Route for showing a single meeting
Route::get('/meetingsd/{meeting}', [AdminController::class, 'showMeeting'])->name('meetings.show');

// Route for showing the form to edit a meeting
Route::get('/meetingsd/{meeting}/edit', [AdminController::class, 'editMeeting'])->name('meetings.edit');

// Route for updating a meeting
Route::put('/meetingsd/{meeting}', [AdminController::class, 'updateMeetingMeeting'])->name('meetings.update');

// Route for deleting a meeting
Route::delete('/meetingsd/{meeting}', [AdminController::class, 'destroMeeting'])->name('meetings.destroy');




Route::get('/reportd', [AdminController::class, 'report'])->name('report');


Route::post('/daily_in_out/check-in', [AdminController::class, 'checkIn'])->name('daily_in_out.checkIn');
Route::post('/daily_in_out/check-out', [AdminController::class, 'checkOut'])->name('daily_in_out.checkOut');



Route::prefix('positionsd')->group(function () {
    Route::get('/', [AdminController::class, 'indexPosition'])->name('positions.index');
    Route::get('/create', [AdminController::class, 'createPosition'])->name('positions.create');
    Route::post('/', [AdminController::class, 'storePosition'])->name('positions.store');
    Route::get('/{position}', [AdminController::class, 'showPosition'])->name('positions.show');
    Route::get('/{position}/edit', [AdminController::class, 'editPosition'])->name('positions.edit');
    Route::put('/{position}', [AdminController::class, 'updatePosition'])->name('positions.update');
    Route::delete('/{position}', [AdminController::class, 'destroyPosition'])->name('positions.destroy');
});






Route::get('/ticket', [AdminController::class, 'indexTicket'])->name('tickets.index');
Route::get('/ticket/create', [AdminController::class, 'createTicket'])->name('tickets.create');
Route::post('/ticket', [AdminController::class, 'storeTicket'])->name('tickets.store');
Route::get('/ticket/{ticket}/edit', [AdminController::class, 'editTicket'])->name('tickets.edit');
Route::put('/ticket/{ticket}', [AdminController::class, 'updateTicket'])->name('tickets.update');
Route::delete('/ticket/{ticket}', [AdminController::class, 'destroyTicket'])->name('tickets.destroy');





//hrhome_hr
Route::get('/home_hr', [HrController::class, 'showall'])->name('home_hr');
Route::get('/employeesh', [HrController::class, 'showallem'])->name('employeesh');
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




// routes/web.php
Route::get('/attendance/{employee}', [HrController::class, 'showa'])->name('attendance.show');
Route::get('/attendance/edit/{id}', [HrController::class, 'edita'])->name('attendance.edit');
Route::put('/attendance/update/{id}', [HrController::class, 'updatea'])->name('attendance.update');


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


Route::resource('job_offers', JobOfferController::class);
Route::get('/career', [JobOfferController::class, 'show'])->name('career');
Route::post('/job/{id}/apply', [JobOfferController::class, 'apply'])->name('job.apply');




Route::get('/departmentsh/{id}/edit', [HrController::class, 'editde'])->name('departmentsh.edit');
Route::delete('/departmentsh/{id}', [HrController::class, 'destroyde'])->name('departmentsh.destroy');
Route::put('/departmentsh/{id}', [HrController::class, 'updatede'])->name('departmentsh.update');








Route::get('/postsh', [HrController::class, 'indexposts'])->name('postsh.index');
