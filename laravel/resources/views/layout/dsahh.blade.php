<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Adminmart Template - The Ultimate Multipurpose admin template</title>
    @guest
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endguest

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
                        // Fetch the authenticated user's employee ID
                        $employeeId = auth()->user()->employee->id;

                        // Fetch all pending tasks for the authenticated user's employee ID
                        $pendingTasks = \App\Models\Task::where('employee_id', $employeeId)
                            ->where('status', 'Pending')
                            ->get()->map(function ($task) {
                                return [
                                    'type' => 'task',
                                    'description' => $task->description,
                                    'created_at' => $task->created_at,
                                    'title' => $task->title // You can also include the title if needed
                                ];
                            });

                        // Fetch all open tickets for the authenticated user's employee ID
                        $pendingTickets = \App\Models\Ticket::where('employee_id', $employeeId)
                            ->where('status', 'Open')
                            ->get()->map(function ($ticket) {
                                return [
                                    'type' => 'ticket',
                                    'description' => $ticket->description,
                                    'created_at' => $ticket->created_at,
                                    'title' => $ticket->subject // Assuming 'subject' is what you want for tickets
                                ];
                            });

                        // Fetch approved leave requests for the authenticated user's employee ID
                        $pendingRequests = \App\Models\LeaveRequest::where('employee_id', $employeeId)
                            ->where('status', 'Approved')
                            ->get()->map(function ($request) {
                                return [
                                    'type' => 'leave_request',
                                    'description' => "Leave from {$request->start_date} to {$request->end_date}", // Example description
                                    'created_at' => $request->created_at,
                                    'title' => 'Leave Request' // You can set a static title or customize
                                ];
                            });

                        // Merge all notifications into one collection
                        $pendingNotifications = collect($pendingTasks)->merge($pendingTickets)->merge($pendingRequests);
                    @endphp

                    <!-- Notification -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                           id="bell" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i data-feather="bell" class="svg-icon"></i></span>
                            <span class="badge badge-pill badge-primary notify-no position-absolute"
                                  style="top: 8px; right: 8px; font-size: 0.8rem;">
                                {{ $pendingNotifications->count() }}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown p-0"
                             style="min-width: 300px; border-radius: 8px;">
                            <ul class="list-style-none mb-0">
                                <li>
                                    <div class="message-center notifications position-relative py-2">
                                        @forelse ($pendingNotifications as $notification)
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2"
                                               style="text-decoration: none;">
                                                <div class="btn btn-warning btn-circle mr-2">
                                                    <i data-feather="alert-circle" class="text-white"></i>
                                                </div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1 text-dark">
                                                        {{ $notification['description'] }}
                                                    </h6>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}</small>
                                                </div>
                                            </a>
                                        @empty
                                            <div class="text-center py-3 text-muted">No pending notifications</div>
                                        @endforelse
                                    </div>
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
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <a href="{{ route('employee_p.edit', ['id' => auth()->id()]) }}">
                                    <img src="{{ asset('assets/images/users/user.jpg') }}" alt="user" class="rounded-circle" width="40">
                                </a>
                                <span class="ml-2 d-none d-lg-inline-block">
                                    <span>Hello,</span>
                                    <span class="text-dark">{{ auth()->user()->name }}</span>

                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="pl-4 p-3">
                                    @php
                                        // Assuming you have a method to get the employee ID based on the authenticated user
                                        $employeeId = auth()->user()->employee->id ?? null; // Replace 'employee' with the correct relation
                                    @endphp

                                    @if($employeeId)
                                        <a href="{{ route('employee_p.edit', ['id' => auth()->id()]) }}" class="btn btn-warning btn-sm">Edit Employee</a>
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
                            <a class="sidebar-link sidebar-link" href="{{ route('home_hr') }}" aria-expanded="false">
                                <i class="fas fa-tachometer-alt"></i> <!-- Dashboard Icon -->
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="{{ route('employeesh') }}" aria-expanded="false">
                                <i class="fas fa-users"></i> <!-- Employees Icon -->
                                <span class="hide-menu">Employees</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('meetingsh.index') }}" aria-expanded="false">
                                <i class="fas fa-calendar-alt"></i> <!-- Meetings Icon -->
                                <span class="hide-menu">Meetings</span>
                            </a>
                        </li>



                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('postsh.index') }}" aria-expanded="false">
                                <i class="fas fa-sticky-note"></i> <!-- All Posts Icon -->
                                <span class="hide-menu">All Post</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('tasksh.index') }}" aria-expanded="false">
                                <i class="fas fa-tasks"></i> <!-- Tasks Icon -->
                                <span class="hide-menu">Tasks</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('teamsh.index') }}" aria-expanded="false">
                                <i class="fas fa-users"></i> <!-- Teams Icon -->
                                <span class="hide-menu">Teams</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('attendance.indexx') }}" aria-expanded="false">
                                <i class="fas fa-calendar-check"></i> <!-- Attendance Icon -->
                                <span class="hide-menu">Calendar</span>
                            </a>
                        </li>
            <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('reporth') }}" aria-expanded="false">
                                <i class="fas fa-dollar-sign"></i> <!-- Salary Report Icon -->
                                <span class="hide-menu">Salary Report</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('hr.leave_requestsi') }}" aria-expanded="false">
                                <i class="fas fa-file-alt"></i> <!-- Leave Requests Icon -->
                                <span class="hide-menu">Leave Requests</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('departmentsh') }}" aria-expanded="false">
                                <i class="fas fa-sitemap"></i> <!-- Departments Icon -->
                                <span class="hide-menu">Departments</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('positionsh.index') }}" aria-expanded="false">
                                <i class="fas fa-user"></i> <!-- Positions Icon -->
                                <span class="hide-menu">Positions</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('job_offers.index') }}" aria-expanded="false">
                                <i class="fas fa-briefcase"></i> <!-- Job Offers Icon -->
                                <span class="hide-menu">Job Offers</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('job.requests.index') }}" aria-expanded="false">
                                <i class="fas fa-file"></i> <!-- Job Requests Icon -->
                                <span class="hide-menu">Job Requests</span>
                            </a>
                        </li>

                        <li class="list-divider"></li>
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

