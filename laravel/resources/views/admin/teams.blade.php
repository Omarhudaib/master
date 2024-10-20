@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-1">Teams</h2>


                    <div class="card-body ">
                        <a href="{{ route('teams.create') }}" class="btn btn-info mb-2">Add Team</a>


                <!-- Card for displaying list of teams -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Teams List</h4>
                    </div>
                    <div class="card-body">
                        <!-- Table Layout for Larger Screens -->
                        <div class="d-none d-md-block">
                            <table class="table table-striped table-hover">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Team Leader</th>
                                        <th>Description</th>
                                        <th>Employees</th>

                                        <th>Add Employee</th>
                                        <th>Remove Employee</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teams as $team)
                                    <tr>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->department ? $team->department->name : 'N/A' }}</td>
                                        <td>{{ $team->teamLeader->first_name ?? 'N/A' }} {{ $team->teamLeader->last_name ?? 'N/A' }}</td>
                                        <td>{{ $team->description ?? 'No description available' }}</td>
                                        <td>
                                            @if($team->employees->isEmpty())
                                                No employees assigned
                                            @else
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($team->employees as $employee)
                                                        <li>{{ $employee->first_name }} {{ $employee->last_name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Add Employee Form -->
                                            <form action="{{ route('teams.addEmployees') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="team_id" value="{{ $team->id }}">
                                                <div class="form-group">
                                                    <select name="employee_ids[]" class="form-control"  required>
                                                        @foreach($availableEmployees as $employee)
                                                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </form>
                                        </td>
                                        <td>
                                            <!-- Remove Employee Form -->
                                            <form action="#" method="POST" class="remove-employee-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="team_id" value="{{ $team->id }}">
                                                <div class="form-group">
                                                    <select name="employee_id" class="form-control" required>
                                                        @foreach($team->employees as $employee)
                                                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('teams.edit', $team->id) }}">Edit</a>
                                                    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.remove-employee-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const teamId = this.querySelector('input[name="team_id"]').value;
            const employeeId = this.querySelector('select[name="employee_id"]').value;

            if (teamId && employeeId) {
                // Construct the URL for the DELETE request
                const formAction = `/teams/${teamId}/employees/${employeeId}`;
                this.action = formAction;
                this.submit();
            } else {
                alert('Please select both a team and an employee.');
            }
        });
    });
</script>
@include('layout.Footer')
