@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">

                <!-- Card for displaying employee details -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Employee Information</h4>
                    </div>
                    <div class="card-body">
                        @if($employee)
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Name:</strong></div>
                                <div class="col-md-8">{{ $employee->user->name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Email:</strong></div>
                                <div class="col-md-8">{{ $employee->user->email }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Role:</strong></div>
                                <div class="col-md-8">{{ $employee->user->role->name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>First Name:</strong></div>
                                <div class="col-md-8">{{ $employee->first_name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Last Name:</strong></div>
                                <div class="col-md-8">{{ $employee->last_name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Date of Birth:</strong></div>
                                <div class="col-md-8">{{ $employee->date_of_birth }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Hire Date:</strong></div>
                                <div class="col-md-8">{{ $employee->hire_date }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Department:</strong></div>
                                <div class="col-md-8">{{ $employee->department->name ?? 'N/A' }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Position:</strong></div>
                                <div class="col-md-8">{{ $employee->position->title ?? 'N/A' }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Salary:</strong></div>
                                <div class="col-md-8">${{ number_format($employee->salary, 2) }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>National ID:</strong></div>
                                <div class="col-md-8">{{ $employee->national_id }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Marital Status:</strong></div>
                                <div class="col-md-8">{{ $employee->marital_status }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Phone Number:</strong></div>
                                <div class="col-md-8">{{ $employee->phone_number }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Employee Identifier:</strong></div>
                                <div class="col-md-8">{{ $employee->employee_identifier }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Sick Leaves:</strong></div>
                                <div class="col-md-8">{{ $employee->sick_leaves }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Annual Vacation Days:</strong></div>
                                <div class="col-md-8">{{ $employee->annual_vacation_days }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Teams:</strong></div>
                                <div class="col-md-8">
                                    @if($employee->teams->isEmpty())
                                        No teams assigned
                                    @else
                                        <ul class="list-unstyled">
                                            @foreach($employee->teams as $team)
                                                <li>{{ $team->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        @else
                            <p>Employee data not found.</p>
                        @endif
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('employeesh') }}" class="btn btn-primary">Back to Employees</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
