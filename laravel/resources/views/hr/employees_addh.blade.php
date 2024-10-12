@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Add Employee</h2>

                <!-- Card for creating a new employee -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Employee Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employeesh.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="user_id">User ID:</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="first_name">First Name:</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="date_of_birth">Date of Birth:</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="hire_date">Hire Date:</label>
                                <input type="date" name="hire_date" id="hire_date" class="form-control" value="{{ old('hire_date') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="department_id">Department:</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="position_id">Position:</label>
                                <select name="position_id" id="position_id" class="form-control">
                                    <option value="">Select Position</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                            {{ $position->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="related_employee_id">Related Employee:</label>
                                <select name="related_employee_id[]" id="related_employee_id" class="form-control" multiple>
                                    <option value="">Select Related Employee(s)</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ in_array($employee->id, old('related_employee_id', [])) ? 'selected' : '' }}>
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="relation_type">Relation Type:</label>
                                <select name="relation_type[]" id="relation_type" class="form-control" multiple>
                                    <option value="">Select Relation Type</option>
                                    <option value="Manager" {{ in_array('Manager', old('relation_type', [])) ? 'selected' : '' }}>Manager</option>
                                    <option value="Supervisor" {{ in_array('Supervisor', old('relation_type', [])) ? 'selected' : '' }}>Supervisor</option>
                                    <option value="Mentor" {{ in_array('Mentor', old('relation_type', [])) ? 'selected' : '' }}>Mentor</option>
                                    <option value="Peer" {{ in_array('Peer', old('relation_type', [])) ? 'selected' : '' }}>Peer</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="salary">Salary:</label>
                                <input type="number" step="0.01" name="salary" id="salary" class="form-control" value="{{ old('salary') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="national_id">National ID:</label>
                                <input type="text" name="national_id" id="national_id" class="form-control" value="{{ old('national_id') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="marital_status">Marital Status:</label>
                                <select name="marital_status" id="marital_status" class="form-control">
                                    <option value="">Select Marital Status</option>
                                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="employee_identifier">Employee Identifier:</label>
                                <input type="text" name="employee_identifier" id="employee_identifier" class="form-control" value="{{ old('employee_identifier') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="sick_leaves">Sick Leaves:</label>
                                <input type="number" name="sick_leaves" id="sick_leaves" class="form-control" value="{{ old('sick_leaves') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="annual_vacation_days">Annual Vacation Days:</label>
                                <input type="number" name="annual_vacation_days" id="annual_vacation_days" class="form-control" value="{{ old('annual_vacation_days') }}">
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Create Employee</button>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

        </div>
    </div>
</div>

</div>

<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dist/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Adminmart Template - The Ultimate Multipurpose admin template</title>

    <!-- Custom CSS -->
    <link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="{{ route('employeesh') }}">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />

                                <!-- Light Logo icon -->
                                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="{{ asset('assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="{{ asset('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        @php
                        // Fetch all pending requests for the authenticated user
                        $pendingRequests = \App\Models\Erequest::where('status', 'Pending')->get();
                    @endphp

                    <!-- Notification -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                           id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <span><i data-feather="bell" class="svg-icon"></i></span>
                            <span class="badge badge-primary notify-no rounded-circle">{{ $pendingRequests->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                            <ul class="list-style-none">
                                <li>
                                    <div class="message-center notifications position-relative">
                                        @forelse ($pendingRequests as $request)
                                            <p
                                               class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-danger">
                                                    <i data-feather="airplay" class="text-white"></i>
                                                </div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">{{ $request->description }}</h6>
                                                </div>
                                            </p>
                                        @empty
                                            <div class="text-center py-2">No pending requests</div>
                                        @endforelse
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link pt-3 text-center text-dark" href="{{ route('requestsh.index') }}">
                                        <strong>Check all notifications</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- End Notification -->

                        <!-- End Notification -->
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->


                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/profile-pic.jpg') }}" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ml-2 d-none d-lg-inline-block">
                                    <span>Hello,</span>
                                    <span class="text-dark">{{ auth()->user()->name }}</span>
                                    <i data-feather="chevron-down" class="svg-icon"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="pl-4 p-3">
                                    @php
                                        // Assuming you have a method to get the employee ID based on the authenticated user
                                        $employeeId = auth()->user()->employee->id ?? null; // Replace 'employee' with the correct relation
                                    @endphp

                                    @if($employeeId)
                                        <a href="{{ route('employeesh.edit', $employeeId) }}" class="btn btn-warning btn-sm">Edit Employee</a>
                                        <a href="{{ route('chath.show', $employeeId) }}" class="btn btn-info btn-sm">Chat</a>
                                    @else
                                        <span class="text-danger">No employee record found.</span>
                                    @endif
                                </div>
                            </div>
                        </li>

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
   -     <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="{{ route('employeesh') }}" aria-expanded="false">
                                <i data-feather="home" class="feather-icon"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('meetingsh.index') }}" aria-expanded="false">
                                <i class="fas fa-calendar-alt"></i> <!-- Icon for Meetings -->
                                <span class="hide-menu">Meetings</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('reporth') }}" aria-expanded="false">
                                <i class="fas fa-dollar-sign"></i> <!-- Icon for Salary Report -->
                                <span class="hide-menu">Salary Report</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('tasksh.index') }}" aria-expanded="false">
                                <i class="fas fa-tasks"></i> <!-- Icon for Tasks -->
                                <span class="hide-menu">Tasks</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('teamsh.index') }}" aria-expanded="false">
                                <i class="fas fa-users"></i> <!-- Icon for Teams -->
                                <span class="hide-menu">Teams</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('attendance.indexx') }}" aria-expanded="false">
                                <i class="fas fa-calendar-check"></i> <!-- Icon for Calendar -->
                                <span class="hide-menu">Calendar</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('hr.leave_requestsi') }}" aria-expanded="false">
                                <i class="fas fa-file-alt"></i> <!-- Icon for Leave Requests -->
                                <span class="hide-menu">Leave Requests</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('departmentsh') }}" aria-expanded="false">
                                <i class="fas fa-sitemap"></i> <!-- Icon for Departments -->
                                <span class="hide-menu">Departments</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('positionsh.index') }}" aria-expanded="false">
                                <i class="fas fa-user-tag"></i> <!-- Icon for Positions -->
                                <span class="hide-menu">Positions</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('job_offers.index') }}" aria-expanded="false">
                                <i class="fas fa-briefcase"></i> <!-- Icon for Job Offers -->
                                <span class="hide-menu">Job Offers</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('job.requests.index') }}" aria-expanded="false">
                                <i class="fas fa-file-alt"></i> <!-- Icon for Job Requests -->
                                <span class="hide-menu">Job Requests</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger ml-3">Logout</button>
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

