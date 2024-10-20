@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Add Employee</h2>

                <!-- Card for creating a new employee -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Employee Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employees.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">User ID:</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="first_name">First Name:</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="date_of_birth">Date of Birth:</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <label for="hire_date">Hire Date:</label>
                                <input type="date" name="hire_date" id="hire_date" class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <label for="department_id">Department:</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="position_id">Position:</label>
                                <select name="position_id" id="position_id" class="form-control">
                                    <option value="">Select Position</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->title }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group mt-3">
                                <label for="salary">Salary:</label>
                                <input type="number" step="0.01" name="salary" id="salary" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Create Employee</button>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@include('layout.Footer')
