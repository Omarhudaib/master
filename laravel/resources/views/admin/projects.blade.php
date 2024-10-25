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
                            <div class="mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search ..." onkeyup="searchTable()">
                            </div>
                            <table class="table table-bordered table-hover" id="Table">
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
                                    @forelse($projects as $project)
                                        <tr>
                                            <td>{{ $project->name }}</td>
                                            <td>{{ $project->description ?? 'N/A' }}</td>
                                            <td>{{ $project->start_date ?? 'N/A' }}</td>
                                            <td>{{ $project->end_date ?? 'N/A' }}</td>
                                            <td>{{ $project->status }}</td>
                                            <td>{{ $project->team->name ?? 'N/A' }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Project Actions">
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
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No projects found.</td> <!-- Message for no projects -->
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Card Layout for Smaller Screens -->
                <div class="d-md-none">
                    <div class="row">
                        @forelse($projects as $project)
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
                        @empty
                            <div class="col-12 mb-4 text-center">No projects found.</div> <!-- Message for no projects in card layout -->
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function searchTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const table = document.getElementById('Table');
        const rows = table.getElementsByTagName('tr');

        // Loop through all rows (starting from index 1 to skip header)
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            // Loop through the cells in the current row
            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];

                if (cell && cell.textContent.toLowerCase().includes(input)) {
                    found = true;
                    break; // No need to check further cells in this row
                }
            }

            // Show or hide the row based on search result
            rows[i].style.display = found ? '' : 'none';
        }
    }
</script>

@include('layout.Footer')
