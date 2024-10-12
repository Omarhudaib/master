@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-1">Teams</h2>

                <!-- Card for creating new team -->



                    <div class="card-body">
                        <a href="{{ route('teamsh.create') }}" class="btn btn-info mb-3">Add Team</a>
                    </div>


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
                                            <form action="{{ route('teamsh.addEmployees') }}" method="POST">
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
                                            <a href="{{ route('teamsh.edit', $team->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('teamsh.destroy', $team->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
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

</body>
</html>
