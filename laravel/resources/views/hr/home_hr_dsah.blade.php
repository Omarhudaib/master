@include('layout.dsahh')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <!-- Alerts for Check-in/Check-out -->
        @if($canCheckIn)
            <div class="alert alert-warning text-center">
                You haven't checked in yet. Please check in to start your day.
            </div>
        @endif

        <form action="{{ route('daily_in_out.checkIn') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary" id="checkInButton" {{ $canCheckIn ? '' : 'disabled' }}>Check In</button>
        </form>

        @if($canCheckOut)
            <form action="{{ route('daily_in_out.checkOut') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-danger" id="checkOutButton">Check Out</button>
            </form>
        @endif
    </div>

    <div class="card-body bg-white">
        <div class="row">
            <div class="col-12">
   

                <!-- Dashboard Summary Section -->
                <div class="container-fluid">
                    <div class="row mt-4">
                        <!-- Summary Cards -->
                        @foreach ([
                          ['Total Employees', $employeeCount, 'bg-primary'],
                        ['Leave Requests', $pendingLeaveRequestCount, 'bg-danger'],
                        ['Total Teams', $teamCount, 'bg-success'],
                        ['Total Departments', $departmentCount, 'bg-info'],
                            ['Total Employees', $totalEmployees, 'bg-primary'],
                            ['Total Projects', $totalProjects, 'bg-success'],
                            ['Total Tasks', $totalTasks, 'bg-warning'],
                            ['Total Departments', $totalDepartments, 'bg-info'],
                            ['Leave Requests', $totalLeaveRequests, 'bg-danger'],
                            ['Active Projects', $activeProjects, 'bg-dark'],
                            ['Done Projects', $doneProjects, 'bg-secondary'],
                            ['Planned Projects', $plannedProjects, 'bg-success'],
                            ['Total Check-Ins', $totalCheckIns, 'bg-purple'],
                            ['Pending Tasks', $pendingTasks, 'bg-warning'],
                            ['Meetings', $meetings, 'bg-info'],
                            ['Pending Tickets', $pendingTicket, 'bg-warning'],
                        ] as [$title, $count, $bgClass])
                        <div class="col-md-3 mt-3">
                            <div class="card card-hover">
                                <div class="p-2 {{ $bgClass }} text-center">
                                    <h4 class="font-weight-light text-white">{{ $count }}</h4>
                                    <h6 class="text-white">{{ $title }}</h6>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Teams Section -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h2>Teams</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-warning text-white">
                                        <tr>
                                            <th>Team Name</th>
                                            <th>Team Leader</th>
                                            <th>Project Name</th>
                                            <th>End Date</th>
                                            <th>Employees</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teams as $team)
                                            <tr>
                                                <td>{{ $team->name }}</td>
                                                <td>{{ $team->leader->name ?? 'No leader assigned' }}</td>
                                                <td>{{ $team->projects->isNotEmpty() ? $team->projects->first()->name : 'No projects' }}</td>
                                                <td>{{ $team->projects->isNotEmpty() ? $team->projects->first()->end_date : 'N/A' }}</td>
                                                <td>{{ $team->employees->isNotEmpty() ? $team->employees->count() : 'No employees' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Posts Section -->
                    <div class="col-md-12 mt-4">
                        <h2>Recent Posts</h2>
                        <p class="text-muted">Stay updated with the latest posts from your team.</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Content</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->user->name ?? 'Unknown' }}</td>
                                            <td>{{ $post->content }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="mt-2">
                            {{ $posts->links() }}
                        </div>
                    </div>

                    <!-- Row for Tables -->
                    <div class="row mt-4">
                        <!-- Departments Table -->
                        <div class="col-md-6">
                            <h4>Departments</h4>
                            <table class="table table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>Department Name</th>
                                        <th>Number of Employees</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $department)
                                        <tr>
                                            <td>{{ $department->name }}</td>
                                            <td>{{ $department->employees_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Employees Who Checked In Today Table -->
                        <div class="col-md-6">
                            <h4>Employees Who Checked In Today</h4>
                            <table class="table table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>Name</th>
                                        <th>Check-in Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($checkedInEmployees as $record)
                                        <tr>
                                            <td>{{ $record->employee->user->name }}</td>
                                            <td>{{ $record->check_in }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
