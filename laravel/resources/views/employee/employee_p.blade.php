

@include('layout.dsah')
<div class="page-wrapper">
    <div class="container-fluid">
        <h2>Employee Details</h2>
        <div class="col-md-12">
        

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

        <form action="{{ route('employee_p.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
            <!-- Updatable Fields -->
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $employee->first_name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $employee->last_name }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $employee->date_of_birth }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="national_id">National ID</label>
                        <input type="text" name="national_id" id="national_id" class="form-control" value="{{ $employee->national_id }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marital_status">Marital Status</label>
                        <select name="marital_status" id="marital_status" class="form-control" required>
                            <option value="single" {{ $employee->marital_status == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="married" {{ $employee->marital_status == 'married' ? 'selected' : '' }}>Married</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $employee->phone_number }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="employee_identifier">Employee Identifier</label>
                <input type="text" name="employee_identifier" id="employee_identifier" class="form-control" value="{{ $employee->employee_identifier }}" required>
            </div>

            <!-- Collapsible Section for Read-Only Fields -->
            <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#readOnlyFields">
                        View Read-Only Information
                    </a>
                </div>
                <div id="readOnlyFields" class="collapse">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="hire_date">Hire Date (Read Only)</label>
                            <input type="text" id="hire_date" class="form-control" value="{{ $employee->hire_date }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="department_id">Department (Read Only)</label>
                            <input type="text" id="department_id" class="form-control" value="{{ $employee->department }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="position_id">Position (Read Only)</label>
                            <input type="text" id="position_id" class="form-control" value="{{ $employee->position }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="salary">Salary (Read Only)</label>
                            <input type="text" id="salary" class="form-control" value="{{ $employee->salary }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="sick_leaves">Sick Leaves (Read Only)</label>
                            <input type="text" id="sick_leaves" class="form-control" value="{{ $employee->sick_leaves }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="annual_vacation_days">Annual Vacation Days (Read Only)</label>
                            <input type="text" id="annual_vacation_days" class="form-control" value="{{ $employee->annual_vacation_days }}" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Employee</button>
        </form>
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
