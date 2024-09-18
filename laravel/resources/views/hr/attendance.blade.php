@include('layout.dsahh')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
<div class="container">
    <h1>Employee Attendance</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Position</th>
                <th>Attendance Status</th>
                <th>Off Day</th>
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
                    <!-- Logic to check if today is an off day (you may adjust based on your actual off days implementation) -->
                    @if($employee->isOnOffDay())
                        Yes
                    @else
                        No
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
