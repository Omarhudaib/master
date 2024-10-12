

@include('layout.dsahad')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <h2>Edit Employee</h2>
            <div class="table-responsive">
                <form action="{{ route('employeesda.update', $employee->id) }}" method="POST">
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


                    <button type="submit" class="btn btn-primary">Update Employee</button>
                    <a href="{{ route('employeesda') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include your JavaScript files as needed -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dist/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<!-- Custom JavaScript -->
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<!-- This page JavaScript -->
<script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
