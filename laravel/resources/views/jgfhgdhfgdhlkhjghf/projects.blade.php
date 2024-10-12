@include('layout.dsahad')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">All Projects</h2>
                <a href="{{ route('projectsda.create') }}" class="btn btn-info mb-3">Add Project</a>

                <!-- Table Layout for Larger Screens -->
                <div class="d-none d-md-block">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Projects</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Team</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                    <tr>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->description ?? 'N/A' }}</td>
                                        <td>{{ $project->start_date ?? 'N/A' }}</td>
                                        <td>{{ $project->end_date ?? 'N/A' }}</td>
                                        <td>{{ $project->status }}</td>
                                        <td>{{ $project->team->name ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('projectsda.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('projectsda.destroy', $project->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Card Layout for Smaller Screens -->
                <div class="d-md-none">
                    <div class="row">
                        @foreach($projects as $project)
                        <div class="col-12 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $project->name }}</h5>
                                    <p class="card-text">
                                        <strong>Description:</strong> {{ $project->description ?? 'N/A' }}<br>
                                        <strong>Start Date:</strong> {{ $project->start_date ?? 'N/A' }}<br>
                                        <strong>End Date:</strong> {{ $project->end_date ?? 'N/A' }}<br>
                                        <strong>Status:</strong> {{ $project->status }}<br>
                                        <strong>Team:</strong> {{ $project->team->name ?? 'N/A' }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('projectsda.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('projectsda.destroy', $project->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
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
