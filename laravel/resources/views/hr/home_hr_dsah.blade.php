@include('layout.dsahh')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row m-3">
        <!-- Blade view for the employee dashboard or wherever you want to place the button -->
        <form action="{{ route('daily_in_out.checkIn') }}" method="POST">
            @csrf
            <input type="hidden" name="location_in" id="locationIn"> <!-- Hidden input for location -->
            <button type="submit" class="btn btn-primary m-1" id="checkInButton">Check In</button>
        </form>

        <form id="checkOutForm" action="{{ route('daily_in_out.checkOut') }}" method="POST">
            @csrf
            <input type="hidden" name="location_out" id="locationOut"> <!-- Hidden input for location -->
            <button type="button" class="btn btn-danger m-1" id="checkOutButton">Check Out</button>
        </form>
    </div>

    <!-- Confirmation Card -->
    <div class="modal fade" id="checkoutConfirmation" tabindex="-1" aria-labelledby="confirmationLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationLabel">Confirm Check Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to check out?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelButton">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmCheckOut">Confirm Check Out</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get user's location and set it in the hidden field for Check In
            navigator.geolocation.getCurrentPosition(function(position) {
                const locationIn = position.coords.latitude + ',' + position.coords.longitude;
                document.getElementById('locationIn').value = locationIn;
                console.log('Check In Location:', locationIn); // Debugging line
            }, function(error) {
                console.error('Error getting Check In location:', error);
            });

            // Get user's location and set it in the hidden field for Check Out
            navigator.geolocation.getCurrentPosition(function(position) {
                const locationOut = position.coords.latitude + ',' + position.coords.longitude;
                document.getElementById('locationOut').value = locationOut;
                console.log('Check Out Location:', locationOut); // Debugging line
            }, function(error) {
                console.error('Error getting Check Out location:', error);
            });

            // Show confirmation card on Check Out button click
            document.getElementById('checkOutButton').addEventListener('click', function() {
                const confirmationModal = new bootstrap.Modal(document.getElementById('checkoutConfirmation'));
                confirmationModal.show();
            });

            // Confirm Check Out
            document.getElementById('confirmCheckOut').addEventListener('click', function() {
                document.getElementById('checkOutForm').submit();
            });

            // Cancel button - redirect to the home page
            document.getElementById('cancelButton').addEventListener('click', function() {
                window.location.href = "{{ route('employee') }}"; // تأكد من استخدام المسار الصحيح لصفحة الرئيسية
            });
        });
    </script>


    <div class="card-body bg-white">
        <div class="row">
            <div class="col-12">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card card-hover">
                    <div class="p-2 bg-primary text-center"> <!-- Blue -->
                        <h1 class="font-light text-white">{{ $deb->name ?? 'N/A' }}</h1>
                        <h6 class="text-white">Department</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card card-hover">
                    <div class="p-2 bg-primary text-center"> <!-- Red -->
                        <h1 class="font-light text-white">{{ $pos->title ?? 'N/A' }}</h1>
                        <h6 class="text-white">Position</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card card-hover">
                    <div class="p-2 bg-primary text-center"> <!-- Green -->
                        <h1 class="font-light text-white">{{ $team_leader->first_name ?? 'N/A' }} {{ $team_leader->last_name ?? '' }}</h1>
                        <h6 class="text-white">Manager</h6>
                    </div>
                </div>
            </div>
         </div>

                <!-- Dashboard Summary Section -->
                <div class="container-fluid">
                    <div class="row mt-4">
                        <!-- Summary Cards -->
                        @foreach ([
                          ['Total Employees', $employeeCount, 'bg-primary'],
                        ['Leave Requests', $pendingLeaveRequestCount, 'bg-primary'],
                        ['Total Teams', $teamCount, 'bg-primary'],
                        ['Total Departments', $departmentCount, 'bg-primary'],
                            ['Total Employees', $totalEmployees, 'bg-primary'],
                            ['Total Projects', $totalProjects, 'bg-primary'],
                            ['Total Tasks', $totalTasks, 'bg-primary'],
                            ['Total Departments', $totalDepartments, 'bg-primary'],
                            ['Leave Requests', $totalLeaveRequests, 'bg-danger'],
                            ['Active Projects', $activeProjects, 'bg-danger'],
                            ['Done Projects', $doneProjects, 'bg-danger'],
                            ['Planned Projects', $plannedProjects, 'bg-danger'],
                            ['Total Check-Ins', $totalCheckIns, 'bg-danger'],
                            ['Pending Tasks', $pendingTasks, 'bg-danger'],
                            ['Meetings', $meetings, 'bg-danger'],
                            ['Pending Tickets', $pendingTicket, 'bg-danger'],
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
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Team Name</th>

                                            <th>Project Name</th>
                                            <th>End Date</th>
                                            <th>Employees</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teams as $team)
                                            <tr>
                                                <td>{{ $team->name }}</td>

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
@include('layout.Footer')
