

@include('layout.dsahh')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
            <h2>Edit Employee</h2>

                <div class="card-header bg-white">
            <div class="table-responsive">
                <form action="{{ route('employeesh.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Specify the HTTP method as PUT for updating --}}

                    <!-- User Information -->
                    <h3>User Information</h3>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}"
                            required
                        >
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"
                            required
                        >
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password: <small>(Leave blank to keep current password)</small></label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                        >
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role_id">Role:</label>
                        <select
                            name="role_id"
                            id="role_id"
                            class="form-control @error('role_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $role)
                                <option
                                    value="{{ $role->id }}"
                                    {{ (old('role_id', $user->role_id) == $role->id) ? 'selected' : '' }}
                                >
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Employee Information -->
                    <h3>Employee Information</h3>
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input
                            type="text"
                            name="first_name"
                            id="first_name"
                            class="form-control @error('first_name') is-invalid @enderror"
                            value="{{ old('first_name', $employee->first_name) }}"
                            required
                        >
                        @error('first_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input
                            type="text"
                            name="last_name"
                            id="last_name"
                            class="form-control @error('last_name') is-invalid @enderror"
                            value="{{ old('last_name', $employee->last_name) }}"
                            required
                        >
                        @error('last_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input
                            type="date"
                            name="date_of_birth"
                            id="date_of_birth"
                            class="form-control @error('date_of_birth') is-invalid @enderror"
                            value="{{ old('date_of_birth', $employee->date_of_birth) }}"
                        >
                        @error('date_of_birth')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hire_date">Hire Date:</label>
                        <input
                            type="date"
                            name="hire_date"
                            id="hire_date"
                            class="form-control @error('hire_date') is-invalid @enderror"
                            value="{{ old('hire_date', $employee->hire_date) }}"
                        >
                        @error('hire_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="department_id">Department:</label>
                        <select
                            name="department_id"
                            id="department_id"
                            class="form-control @error('department_id') is-invalid @enderror"
                        >
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $department)
                                <option
                                    value="{{ $department->id }}"
                                    {{ (old('department_id', $employee->department_id) == $department->id) ? 'selected' : '' }}
                                >
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="position_id">Position:</label>
                        <select
                            name="position_id"
                            id="position_id"
                            class="form-control @error('position_id') is-invalid @enderror"
                        >
                            <option value="">-- Select Position --</option>
                            @foreach($positions as $position)
                                <option
                                    value="{{ $position->id }}"
                                    {{ (old('position_id', $employee->position_id) == $position->id) ? 'selected' : '' }}
                                >
                                    {{ $position->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('position_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="team_id">Team:</label>
                        <select
                            name="team_id"
                            id="team_id"
                            class="form-control @error('team_id') is-invalid @enderror"
                        >
                            <option value="">-- Select Team --</option>
                            @foreach($teams as $team)
                                <option
                                    value="{{ $team->id }}"
                                    {{ (old('team_id', $employee->team_id) == $team->id) ? 'selected' : '' }}
                                >
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('team_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="salary">Salary:</label>
                        <input
                            type="text"
                            name="salary"
                            id="salary"
                            class="form-control @error('salary') is-invalid @enderror"
                            value="{{ old('salary', $employee->salary) }}"
                        >
                        @error('salary')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="national_id">National ID:</label>
                        <input
                            type="text"
                            name="national_id"
                            id="national_id"
                            class="form-control @error('national_id') is-invalid @enderror"
                            value="{{ old('national_id', $employee->national_id) }}"
                            required
                        >
                        @error('national_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="marital_status">Marital Status:</label>
                        <select
                            name="marital_status"
                            id="marital_status"
                            class="form-control @error('marital_status') is-invalid @enderror"
                            required

                            <option value="">-- Select Marital Status --</option>
                            <option value="single" {{ old('marital_status', $employee->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="married" {{ old('marital_status', $employee->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                        </select>
                        @error('marital_status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input
                            type="text"
                            name="phone_number"
                            id="phone_number"
                            class="form-control @error('phone_number') is-invalid @enderror"
                            value="{{ old('phone_number', $employee->phone_number) }}"
                            required
                        >
                        @error('phone_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="employee_identifier">Employee Identifier:</label>
                        <input
                            type="text"
                            name="employee_identifier"
                            id="employee_identifier"
                            class="form-control @error('employee_identifier') is-invalid @enderror"
                            value="{{ old('employee_identifier', $employee->employee_identifier) }}"
                        >
                        @error('employee_identifier')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sick_leaves">Sick Leaves:</label>
                        <input
                            type="number"
                            name="sick_leaves"
                            id="sick_leaves"
                            class="form-control @error('sick_leaves') is-invalid @enderror"
                            value="{{ old('sick_leaves', $employee->sick_leaves) }}"
                        >
                        @error('sick_leaves')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="annual_vacation_days">Annual Vacation Days:</label>
                        <input
                            type="number"
                            name="annual_vacation_days"
                            id="annual_vacation_days"
                            class="form-control @error('annual_vacation_days') is-invalid @enderror"
                            value="{{ old('annual_vacation_days', $employee->annual_vacation_days) }}"
                        >
                        @error('annual_vacation_days')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Employee</button>
                    <a href="{{ route('employeesh') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
