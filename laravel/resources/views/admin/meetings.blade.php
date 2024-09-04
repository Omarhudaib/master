@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Manage Meetings</h2>

                <!-- Button to create a new meeting -->
                <div class=" mb-3">
                    <a href="{{ route('meetings.create') }}" class="btn btn-primary">Create New Meeting</a>
                </div>

                <!-- Card for displaying list of meetings -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Meetings List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Organizer</th>
                                        <th>Manager</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->subject }}</td>
                                        <td>{{ $meeting->meeting_date }}</td>
                                        <td>{{ $meeting->location }}</td>
                                        <td>{{ $meeting->organizer->first_name }}</td>
                                        <td>{{ $meeting->manager ? $meeting->manager->first_name : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('meetings.show', $meeting->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('meetings.edit', $meeting->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST" style="display:inline;">
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

<!-- JavaScript files -->
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
