@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <h1 class="my-4">Employee Attendance</h1>
                    <table class="table table-striped table-bordered">
                        <thead class="thead ">
                            <tr>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Attendance Status</th>
                                <th>Off Day</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td>{{ $employee->department->name ?? 'N/A' }}</td>
                                <td>{{ $employee->position->name ?? 'N/A' }}</td>
                                <td>
                                    @if($employee->dailyInOut->isEmpty())
                                        Not Checked In
                                    @elseif($employee->dailyInOut->first()->check_out)
                                        Checked Out
                                    @else
                                        Checked In
                                    @endif
                                </td>
                                <td>
                                    <!-- Logic to check if today is an off day -->
                                    @if($employee->isOnOffDay())
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('attendance.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dist/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
