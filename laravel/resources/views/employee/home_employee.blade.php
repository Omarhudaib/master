

@include('layout.dsah')

<div class="page-wrapper">
    <div class="page-breadcrumb">

        <!-- Check if the user hasn't checked in yet -->
        @if($canCheckIn)
            <div class="alert alert-warning text-center">
                You haven't checked in yet. Please check in to start your day.
            </div>
        @endif
   <div class="row m-3">
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
        </div>
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
                    <div class="p-2 bg-danger text-center"> <!-- Red -->
                        <h1 class="font-light text-white">{{ $pos->name ?? 'N/A' }}</h1>
                        <h6 class="text-white">Position</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card card-hover">
                    <div class="p-2 bg-success text-center"> <!-- Green -->
                        <h1 class="font-light text-white">{{ $team_leader->first_name ?? 'N/A' }} {{ $team_leader->last_name ?? '' }}</h1>
                        <h6 class="text-white">Manager</h6>
                    </div>
                </div>
            </div>
         </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-primary text-center"> <!-- Blue -->
                                            <h1 class="font-light text-white">{{ $projects }}</h1>
                                            <h6 class="text-white">Total Projects</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-danger text-center"> <!-- Red -->
                                            <h1 class="font-light text-white">{{ $leaveRequests }}</h1>
                                            <h6 class="text-white">Requests</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-success text-center"> <!-- Green -->
                                            <h1 class="font-light text-white">{{ $annual_vacation_days }}</h1>
                                            <h6 class="text-white">Annual Vacation Days</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-warning text-center"> <!-- Yellow -->
                                            <h1 class="font-light text-white">{{ $sick_vacation }}</h1>
                                            <h6 class="text-white">Sick Leaves</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ticket Metrics -->
                            <div class="row mt-4">
                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-info text-center"> <!-- Light Blue -->
                                            <h1 class="font-light text-white">{{ $tickets->count() }}</h1>
                                            <h6 class="text-white">Total Tickets</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-secondary text-center"> <!-- Grey -->
                                            <h1 class="font-light text-white">{{ $responded }}</h1>
                                            <h6 class="text-white">Responded</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-light text-center"> <!-- Light Grey -->
                                            <h1 class="font-light text-dark">{{ $resolved }}</h1>
                                            <h6 class="text-dark">Resolved</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-dark text-center"> <!-- Black -->
                                            <h1 class="font-light text-white">{{ $pending }}</h1>
                                            <h6 class="text-white">Pending</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Task Status Summary -->
                            <div class="row mt-4">
                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-warning text-center"> <!-- Yellow -->
                                            <h1 class="font-light text-white">{{ $pendingTasks }}</h1>
                                            <h6 class="text-white">Pending Tasks</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-info text-center"> <!-- Light Blue -->
                                            <h1 class="font-light text-white">{{ $inProgressTasks }}</h1>
                                            <h6 class="text-white">In Progress Tasks</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-success text-center"> <!-- Green -->
                                            <h1 class="font-light text-white">{{ $completedTasks }}</h1>
                                            <h6 class="text-white">Completed Tasks</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-danger text-center"> <!-- Red -->
                                            <h1 class="font-light text-white">{{ $leaveRequests }}</h1>
                                            <h6 class="text-white">Requests</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4">
                                            <h4 class="card-title">Team Information</h4>
                                            <div class="ml-auto">
                                                <div class="dropdown sub-dropdown">
                                                    <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                            <circle cx="12" cy="5" r="1"></circle>
                                                            <circle cx="12" cy="19" r="1"></circle>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                        <a class="dropdown-item" href="#">Insert</a>
                                                        <a class="dropdown-item" href="#">Update</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table no-wrap v-middle mb-0">
                                                <thead>
                                                    <tr class="border-0 bg-warning text-white">
                                                        <th class="border-0 font-14 font-weight-medium">Team Number</th>
                                                        <th class="border-0 font-14 font-weight-medium">Team Name</th>
                                                        <th class="border-0 font-14 font-weight-medium">Team Leader</th>
                                                        <th class="border-0 font-14 font-weight-medium">Employee Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($teams as $team)
                                                        <tr>
                                                            <td rowspan="{{ $team->employees->count() }}">{{ $team->id }}</td>
                                                            <td rowspan="{{ $team->employees->count() }}">{{ $team->name }}</td>
                                                            <td rowspan="{{ $team->employees->count() }}">{{ $team->teamLeader->first_name ?? 'No Leader' }}</td>
                                                            @foreach($team->employees as $index => $employee)
                                                                @if($index == 0)
                                                                    <td>{{ $employee->first_name }}</td>
                                                                </tr>
                                                                @else
                                                                <tr>
                                                                    <td>{{ $employee->first_name }}</td>
                                                                </tr>
                                                                @endif
                                                            @endforeach
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
                </div>
            </div>
        </div>


    <!-- Footer -->
    <footer class="footer text-center text-muted">
        All Rights Reserved by Adminmart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>
</div>

<!-- ============================================================== -->

<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/app-style-switcher.js"></script>
<script src="dist/js/feather.min.js"></script>
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<script src="dist/js/custom.min.js"></script>
<script src="assets/extra-libs/c3/d3.min.js"></script>
<script src="assets/extra-libs/c3/c3.min.js"></script>
<script src="assets/libs/chartist/dist/chartist.min.js"></script>
<script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="dist/js/pages/dashboards/dashboard1.min.js"></script>
</body>
</html>
