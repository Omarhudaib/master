@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <h2>Team Details</h2>
            <div class="card">
                <div class="card-body">
                    <h3>{{ $team->name }}</h3>
                    <p><strong>Team Leader:</strong> {{ $team->teamLeader->first_name }} {{ $team->teamLeader->last_name }}</p>
                    <p><strong>Description:</strong> {{ $team->description }}</p>

                    <h4>Employees:</h4>
                    @if($team->employees->isEmpty())
                        <p>No employees assigned</p>
                    @else
                        <ul>
                            @foreach($team->employees as $employee)
                                <li>{{ $employee->first_name }} {{ $employee->last_name }}</li>
                            @endforeach
                        </ul>
                        @if($team)
                        <h4>Add Employee</h4>
                        <form action="{{ route('teams.addEmployee', $team->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="add_employee_id">Employee:</label>
                                <select name="employee_id" id="add_employee_id" class="form-control">
                                    @foreach($availableEmployees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Employee</button>
                        </form>
                </div></div>
                        <div class="card">
                            <div class="card-body">
                        <h4>Remove Employee</h4>
                        @if($team->employees->isEmpty())
                            <p>No employees to remove</p>
                        @else
                            <form action="{{ route('teams.removeEmployee', $team->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group">
                                    <label for="remove_employee_id">Employee:</label>
                                    <select name="employee_id" id="remove_employee_id" class="form-control">
                                        @foreach($team->employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-danger">Remove Employee</button>
                            </form>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>


</div>
</div>

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
