@include('layout.dsaha')

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Form for creating a meeting -->
    <!-- ============================================================== -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Create New Meeting
            </div>
            <div class="card-body">
                <form action="{{ route('meetings.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" id="subject" name="subject" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="meeting_date">Meeting Date:</label>
                        <input type="date" id="meeting_date" name="meeting_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="organizer_id">Organizer:</label>
                        <select id="organizer_id" name="organizer_id" class="form-control" required>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->first_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="manager_id">Manager:</label>
                        <select id="manager_id" name="manager_id" class="form-control">
                            <option value="">N/A</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->first_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
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
<script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>

</body>
</html>
