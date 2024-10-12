@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <h2>Manage Relations for {{ $employee->name }}</h2>

                    <h4>Current Relations</h4>
                    <ul>
                        @foreach($employee->relatedEmployees as $relation)
                            <li>{{ $relation->first_name }} - {{ $relation->pivot->relation_type }}
                                <form action="{{ route('employees.removeRelation', [$employee->id, $relation->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                    <h4>Add New Relation</h4>
                    <form action="{{ route('employees.addRelation', $employee->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="related_employee_id">Select Employee</label>
                            <select name="related_employee_id" class="form-control">
                                @foreach($allEmployees as $relatedEmployee)
                                    <option value="{{ $relatedEmployee->id }}">{{ $relatedEmployee->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="relation_type">Relation Type</label>
                            <select name="relation_type" class="form-control">
                                <option value="Manager">Manager</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Mentor">Mentor</option>
                                <option value="Peer">Peer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Relation</button>
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
</body>
</html>
