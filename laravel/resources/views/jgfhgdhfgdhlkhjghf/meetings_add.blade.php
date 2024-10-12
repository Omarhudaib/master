@include('layout.dsahad')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
    <!-- ============================================================== -->
    <!-- Form for creating a meeting -->
    <!-- ============================================================== -->

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Create New Meeting</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('meetingsda.store') }}" method="POST">
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
                        @forelse ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                        @empty
                            <option value="">No employees available</option>
                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <label for="manager_id">Manager:</label>
                    <select id="manager_id" name="manager_id" class="form-control">
                        <option value="" style="font-family: 'Courier New', Courier, monospace;">None</option>
                        @forelse ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                        @empty
                            <option value="">No employees available</option>
                        @endforelse
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Meeting</button>
            </form>
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
