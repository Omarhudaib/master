@include('layout.dsaha')

<div class="page-wrapper">


    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Task Management</h2>
 <a href="{{ route('tasks.create') }}" class="btn btn-info mb-3">Add Task</a>
                <!-- Table Layout for Larger Screens -->
                <div class="d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            @if ($tasks->isNotEmpty())
                                <table class="table table-bordered">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Project</th>
                                            <th>Employee</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $task->title }}</td>
                                                <td>{{ $task->description ?? 'N/A' }}</td>
                                                <td>{{ $task->project->name ?? 'N/A' }}</td>
                                                <td>{{ $task->employee->first_name ?? 'N/A' }} {{ $task->employee->last_name ?? 'N/A' }}</td>
                                                <td>{{ $task->status }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                                                <circle cx="12" cy="12" r="1"></circle>
                                                                <circle cx="12" cy="5" r="1"></circle>
                                                                <circle cx="12" cy="19" r="1"></circle>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <!-- View Option -->
                                                            <a class="dropdown-item" href="{{ route('tasks.show', $task->id) }}">View</a>

                                                            <!-- Delete Option -->
                                                            <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display:inline;">
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
                            @else
                                <p>No tasks found.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card Layout for Smaller Screens -->
                <div class="d-md-none">
                    @if ($tasks->isNotEmpty())
                        @foreach ($tasks as $task)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $task->title }}</h5>
                                    <p class="card-text">
                                        <strong>Description:</strong> {{ $task->description ?? 'N/A' }}<br>
                                        <strong>Project:</strong> {{ $task->project->name ?? 'N/A' }}<br>
                                        <strong>Employee:</strong> {{ $task->employee->first_name ?? 'N/A' }} {{ $task->employee->last_name ?? 'N/A' }}<br>
                                        <strong>Status:</strong> {{ $task->status }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No tasks found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
