

@include('layout.dsah')

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
                                        <div class="p-2 bg-primary text-center"> <!-- Red -->
                                            <h1 class="font-light text-white">{{ $leaveRequests }}</h1>
                                            <h6 class="text-white">Requests</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-primary text-center"> <!-- Green -->
                                            <h1 class="font-light text-white">{{ $annual_vacation_days }}</h1>
                                            <h6 class="text-white">Annual Vacation Days</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-primary text-center"> <!-- Yellow -->
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
                                        <div class="p-2 bg-primary text-center"> <!-- Light Blue -->
                                            <h1 class="font-light text-white">{{ $tickets->count() }}</h1>
                                            <h6 class="text-white">Total Tickets</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-primary text-center"> <!-- Grey -->
                                            <h1 class="font-light text-white">{{ $responded }}</h1>
                                            <h6 class="text-white">Responded</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-primary text-center"> <!-- Light Grey -->
                                            <h1 class="font-light text-white">{{ $resolved }}</h1>
                                            <h6 class="text-white">Resolved</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-primary text-center"> <!-- Black -->
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
                                        <div class="p-2 bg-danger text-center"> <!-- Yellow -->
                                            <h1 class="font-light text-white">{{ $pendingTasks }}</h1>
                                            <h6 class="text-white">Pending Tasks</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-danger text-center"> <!-- Light Blue -->
                                            <h1 class="font-light text-white">{{ $inProgressTasks }}</h1>
                                            <h6 class="text-white">In Progress Tasks</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-danger text-center"> <!-- Green -->
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

                                            </div>
                                        </div>
                                        <div class="table-responsive ">
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
@include('layout.Footer')
