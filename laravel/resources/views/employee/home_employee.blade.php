
Copy code
@include('layout.dsah')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <!-- Check if the user hasn't checked in yet -->
        @if($canCheckIn)
            <div class="alert alert-warning text-center">
                You haven't checked in yet. Please check in to start your day.
            </div>
        @endif

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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Ticket Metrics -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-primary text-center">
                                        <h1 class="font-light text-white">{{ $tickets->count() }}</h1>
                                        <h6 class="text-white">Total Tickets</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-cyan text-center">
                                        <h1 class="font-light text-white">{{ $responded }}</h1>
                                        <h6 class="text-white">Responded</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-success text-center">
                                        <h1 class="font-light text-white">{{ $resolved }}</h1>
                                        <h6 class="text-white">Resolved</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-danger text-center">
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
                                    <div class="p-2 bg-warning text-center">
                                        <h1 class="font-light text-white">{{ $pendingTasks }}</h1>
                                        <h6 class="text-white">Pending Tasks</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-info text-center">
                                        <h1 class="font-light text-white">{{ $inProgressTasks }}</h1>
                                        <h6 class="text-white">In Progress Tasks</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-success text-center">
                                        <h1 class="font-light text-white">{{ $completedTasks }}</h1>
                                        <h6 class="text-white">Completed Tasks</h6>
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
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Team Number</th>
                                                            <th>Team Name</th>
                                                            <th>Team Leader</th>
                                                            <th>Employee Name</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($teams as $team)
                                                            <tr>
                                                                <td rowspan="{{ $team->employees->count() }}">{{ $team->id }}</td>
                                                                <td rowspan="{{ $team->employees->count() }}">{{ $team->name }}</td>
                                                                <td rowspan="{{ $team->employees->count() }}">{{ $team->teamLeader->name ?? 'No Leader' }}</td>

                                                                <!-- Loop through employees in the same team -->
                                                                @foreach($team->employees as $index => $employee)
                                                                    @if($index == 0)
                                                                        <td>{{ $employee->name }}</td>
                                                                        <td>{{ $employee->pivot->created_at }}</td>
                                                                    </tr>
                                                                    @else
                                                                    <tr>
                                                                        <td>{{ $employee->name }}</td>
                                                                        <td>{{ $employee->pivot->created_at }}</td>
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
