@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <!-- Check-in Reminder -->
        @if($canCheckIn)
            <div class="alert alert-warning text-center">
                You haven't checked in yet. Please check in to start your day.
            </div>
        @endif

        <div class="row m-3">
            <!-- Check-in Button -->
            <form action="{{ route('daily_in_out.checkIn') }}" method="POST" class="mr-2">
                @csrf
                <button type="submit" class="btn btn-primary" id="checkInButton" {{ $canCheckIn ? '' : 'disabled' }}>Check In</button>
            </form>

            <!-- Check-out Button -->
            @if($canCheckOut)
                <form action="{{ route('daily_in_out.checkOut') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" id="checkOutButton">Check Out</button>
                </form>
            @endif
        </div>
    </div>

    <!-- Dashboard Summary Section -->
    <div class="container-fluid">
        <div class="row">
            <!-- Card for Total Employees -->
            <div class="col-md-3">
                <div class="card card-hover">
                    <div class="p-2 bg-primary text-center">
                        <h4 class="font-light text-white">{{ $totalEmployees }}</h4>
                        <h6 class="text-white">Total Employees</h6>
                    </div>
                </div>
            </div>

            <!-- Card for Total Projects -->
            <div class="col-md-3">
                <div class="card card-hover">
                    <div class="p-2 bg-success text-center">
                        <h4 class="font-light text-white">{{ $totalProjects }}</h4>
                        <h6 class="text-white">Total Projects</h6>
                    </div>
                </div>
            </div>

            <!-- Card for Total Tasks -->
            <div class="col-md-3">
                <div class="card card-hover">
                    <div class="p-2 bg-warning text-center">
                        <h4 class="font-light text-white">{{ $totalTasks }}</h4>
                        <h6 class="text-white">Total Tasks</h6>
                    </div>
                </div>
            </div>

            <!-- Card for Total Departments -->
            <div class="col-md-3">
                <div class="card card-hover">
                    <div class="p-2 bg-info text-center">
                        <h4 class="font-light text-white">{{ $totalDepartments }}</h4>
                        <h6 class="text-white">Total Departments</h6>
                    </div>
                </div>
            </div>

            <!-- Card for Total Leave Requests -->
            <div class="col-md-3 mt-3">
                <div class="card card-hover">
                    <div class="p-2 bg-danger text-center">
                        <h4 class="font-light text-white">{{ $totalLeaveRequests }}</h4>
                        <h6 class="text-white">Leave Requests</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teams Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Teams</h2>
                <div class="table-responsive">
                    <table class="table no-wrap v-middle mb-0">
                        <thead>
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

        <!-- Daily In/Out Section -->
        <div class="row mt-4">
            <!-- Continue with your daily in/out table as before -->
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
