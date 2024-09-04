@include('layout.dsah')

<div class="page-wrapper">
    <!-- Employee Data -->
    <div class="container-fluid">
        <h2>Employees</h2>


        <!-- Departments Data -->
        <h2> {{ $departments }}</h2>

        <div class="text-center mt-4">
            <form id="day-action-form" action="{{ route('day-action') }}" method="POST">
                @csrf
                <button type="button" class="btn btn-primary" onclick="submitForm('start')">Start My Day</button>
                <button type="button" class="btn btn-secondary" onclick="submitForm('end')">End My Day</button>
                <input type="hidden" name="action" id="action">
            </form>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Position</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->department->name ?? 'N/A' }}</td>
                        <td>{{ $employee->position->title ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tasks Data -->
        <h2>Tasks</h2>
        <div class="table-responsive">
            <table class="table table-hover table-danger">
                <thead class="bg-danger text-white">
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
                        <td>
                            <form action="{{ route('update-status', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="In Progress" {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="On Hold" {{ $task->status === 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                </select>
                            </form>
                        </td>
                        <td>{{ $task->weeks }}</td>
                        <td>${{ $task->budget }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>








        <!-- Positions Data -->
        <h2>Positions</h2>
        <div class="table-responsive">
            <table class="table table-hover table-warning">
                <thead class="bg-warning text-white">
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

        <!-- Leave Requests Data -->
        <h2>Leave Requests</h2>
        <div class="table-responsive">
            <table class="table table-hover table-danger">
                <thead class="bg-danger text-white">
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
                    <tr data-id="{{ $leaveRequest->id }}" class="clickable-row">
                        <form action="{{ route('start-work-day') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" name="leave_request_id" value="{{ $leaveRequest->id }}">
                        </form>
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

        <script>
            document.querySelectorAll('.clickable-row').forEach(row => {
                row.addEventListener('click', function() {
                    this.querySelector('form').submit();
                });
            });
  
            function submitForm(action) {
                document.getElementById('action').value = action;
                document.getElementById('day-action-form').submit();
            }
        </script>
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
