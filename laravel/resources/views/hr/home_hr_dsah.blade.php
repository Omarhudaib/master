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



   <div class="card-body bg-white ">
        <div class="row">
            <div class="col-12">
                <!-- Card Layout for Counts -->
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="card p-2 bg-primary text-center font-light text-white">
                            <div class="card-body">
                                <h4>Total Employees</h4>
                                <p class="card-text">{{ $employeeCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-2 bg-danger text-center font-light text-white">
                            <div class="card-body">
                                <h4>Pending Leave Requests</h4>
                                <p class="card-text">{{ $pendingLeaveRequestCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-2 bg-success text-center font-light text-white">
                            <div class="card-body">
                                <h4>Total Teams</h4>
                                <p class="card-text">{{ $teamCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-2 bg-info text-center font-light text-white">
                            <div class="card-body">
                                <h4>Total Departments</h4>
                                <p class="card-text">{{ $departmentCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row for Tables -->
                <div class="row mt-4">
                    <!-- Departments Table -->
                    <div class="col-md-6">
                        <h4>Departments</h4>
                        <table class="table table-bordered">
                            <thead>
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
                            <thead>
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
