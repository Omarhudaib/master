@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                 <h1 class="text-center mb-4">Employee Attendance</h1>
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Employee Attendance</h4>
                    </div>
                    <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Total Hours</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td>{{ $employee->totalHours }} hours</td>
                                <td>
                                    <a href="{{ route('attendance.show', $employee->id) }}" class="btn btn-info btn-sm">Show Daily In/Out</a>
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
@include('layout.Footer')
