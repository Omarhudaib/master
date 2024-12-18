@if(auth()->user()->role_id == 1)
    @include('layout.dsaha') <!-- Dashboard for role ID 1 -->
@elseif(auth()->user()->role_id == 2)
    @include('layout.dsah') <!-- Dashboard for role ID 2 -->
@elseif(auth()->user()->role_id == 3)
   
    <p>Unauthorized access.</p> <!-- Fallback if no role matches -->
@endif

<div class="page-wrapper">


    <div class="page-breadcrumb">
           <h2>Details</h2>
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('employee_p.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Updatable Fields -->



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
                                        <input type="text" id="department_id" class="form-control" value="{{ $employee->department->name }}" disabled>
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
        </div>
    </div>
</div>
@include('layout.Footer')
