@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Add Employee</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                @if(session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif
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
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="date_of_birth">Date of Birth:</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="hire_date">Hire Date:</label>
                                <input type="date" name="hire_date" id="hire_date" class="form-control" value="{{ old('hire_date') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="department_id">Department:</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group mt-3">
                                <label for="salary">Salary:</label>
                                <input type="number" step="0.01" name="salary" id="salary" class="form-control" value="{{ old('salary') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="national_id">National ID:</label>
                                <input type="text" name="national_id" id="national_id" class="form-control" value="{{ old('national_id') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="marital_status">Marital Status:</label>
                                <select name="marital_status" id="marital_status" class="form-control">
                                    <option value="">Select Marital Status</option>
                                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="employee_identifier">Employee Identifier:</label>
                                <input type="text" name="employee_identifier" id="employee_identifier" class="form-control" value="{{ old('employee_identifier') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="sick_leaves">Sick Leaves:</label>
                                <input type="number" name="sick_leaves" id="sick_leaves" class="form-control" value="{{ old('sick_leaves') }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="annual_vacation_days">Annual Vacation Days:</label>
                                <input type="number" name="annual_vacation_days" id="annual_vacation_days" class="form-control" value="{{ old('annual_vacation_days') }}">
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
