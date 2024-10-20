@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">All Projects</h2>
                <a href="{{ route('projects.create') }}" class="btn btn-info mb-3">Add Project</a>

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
                                            <div class="dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <!-- Edit Option -->
                                                    <a class="dropdown-item" href="{{ route('projects.edit', $project->id) }}">Edit</a>

                                                    <!-- Delete Option -->
                                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
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
                                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
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
@include('layout.Footer')
