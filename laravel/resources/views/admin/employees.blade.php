@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Employees Management</h2>

                <a href="{{ route('employees_add') }}" class="btn btn-info mb-3">Add Employee</a>

                <!-- Search Bar -->
                <form method="GET" action="{{ route('employees') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="department_id" class="form-control">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="position_id" class="form-control">
                                <option value="">Select Position</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}" {{ request('position_id') == $position->id ? 'selected' : '' }}>
                                        {{ $position->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    <button type="submit" class="btn btn-primary ml-3">Search</button>
               </div>  </form>

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
                                            <div class="dropdown sub-dropdown show">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <a class="dropdown-item" href="{{ route('employees.show', $employee->id) }}">Show</a>
                                                    <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}">Update</a>
                                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="dropdown-item" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Are you sure?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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
@include('layout.Footer')
