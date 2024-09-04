@include('layout.dsaha')



<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <!-- Blade view for the employee dashboard or wherever you want to place the button -->
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

        <div class="row">
    <h2>Employees</h2>
    <div class="table-responsive">
        <table class="table no-wrap v-middle mb-0">
            <thead>
                <tr class="border-0">
                    <th class="border-0 font-14 font-weight-medium text-muted">Team Name</th>
                    <th class="border-0 font-14 font-weight-medium text-muted">Team Leader</th>
                    <th class="border-0 font-14 font-weight-medium text-muted">Project Name</th>
                    <th class="border-0 font-14 font-weight-medium text-muted">End Date</th>
                    <th class="border-0 font-14 font-weight-medium text-muted">Employees</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $team)
                <tr>
                    <td>{{ $team->name }}</td>
                    <td>
                        @if($team->leader)
                            {{ $team->leader->first_name }} {{ $team->leader->last_name }}
                        @else
                            <span class="text-muted">No leader assigned</span>
                        @endif
                    </td>
                    <td>
                        @if($team->projects->isNotEmpty())
                            @foreach($team->projects as $project)
                                <div>{{ $project->name }}</div>
                                <small>{{ $project->end_date }}</small>
                            @endforeach
                        @else
                            <span class="text-muted">No projects assigned</span>
                        @endif
                    </td>
                    <td>
                        @if($team->employees->isNotEmpty())
                            @foreach($team->employees as $employee)
                                <div>{{ $employee->first_name }} {{ $employee->last_name }}</div>
                            @endforeach
                        @else
                            <span class="text-muted">No employees assigned</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tasks Section -->
    <h2>Tasks</h2>
    <div class="table-responsive">
        <table class="table table-hover table-warning">
            <thead class="bg-warning text-white">
                <tr>
                    <th>Employee</th>
                    <th>Project</th>
                    <th>Team</th>
                    <th>Status</th>
                    <th>Weeks</th>
                    <th>Budget</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->employee->name ?? 'Unknown' }}</td>
                    <td>{{ $task->project->name ?? 'N/A' }}</td>
                    <td>{{ $task->team->name ?? 'N/A' }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->weeks }}</td>
                    <td>${{ $task->budget }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Departments Section -->
    <h2>Departments</h2>
    <div class="table-responsive">
        <table class="table table-hover table-danger">
            <thead class="bg-danger text-white">
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td>{{ $department->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Positions Section -->
    <h2>Positions</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-secondary text-white">
                <tr>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                @foreach($positions as $position)
                <tr>
                    <td>{{ $position->title }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Leave Requests Section -->
    <h2>Leave Requests</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th>Employee</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveRequests as $leaveRequest)
                <tr>
                    <td>{{ $leaveRequest->employee->name ?? 'Unknown' }}</td>
                    <td>{{ $leaveRequest->leave_type }}</td>
                    <td>{{ $leaveRequest->start_date }}</td>
                    <td>{{ $leaveRequest->end_date }}</td>
                    <td>{{ $leaveRequest->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Daily In/Out Section -->
    <h2>Daily In/Out Records</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-success text-white">
                <tr>
                    <th>Employee</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dailyInOuts as $record)
                <tr>
                    <td>{{ $record->employee->name ?? 'Unknown' }}</td>
                    <td>{{ $record->check_in }}</td>
                    <td>{{ $record->check_out ?? 'N/A' }}</td>
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

<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dist/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<!-- Custom JavaScript -->
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<!-- This page JavaScript -->
<script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>

</body>
</html>
