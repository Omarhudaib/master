@include('layout.dsahh')



<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
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


                <h2 class="text-center mb-4">Employees Management</h2>

                <a href="{{ route('employees_addh') }}" class="btn btn-info mb-3">Add Employee</a>

                <!-- Table Layout for Larger Screens -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Employees List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Department</th>
                                        <th>Position</th>
                                        <th>Salary</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->user->name }}</td>
                                        <td>{{ $employee->user->email }}</td>
                                        <td>{{ $employee->user->role->name }}</td>
                                        <td>{{ $employee->department->name ?? 'N/A' }}</td>
                                        <td>{{ $employee->position->title ?? 'N/A' }}</td>
                                        <td>${{ number_format($employee->salary, 2) }}</td>
                                        <td>
                                            <a href="{{ route('employeesh.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('employeesh.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('employeesh.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Card Layout for Smaller Screens -->
                <div class="d-sm-none mt-4">
                    <div class="row">
                        @foreach($employees as $employee)
                        <div class="col-12 sm-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $employee->user->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $employee->user->role->name }}</h6>
                                    <table class="table table-sm mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Email:</th>
                                                <td>{{ $employee->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Department:</th>
                                                <td>{{ $employee->department->name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Position:</th>
                                                <td>{{ $employee->position->title ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Salary:</th>
                                                <td>${{ number_format($employee->salary, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
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
