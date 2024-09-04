@include('layout.dsaha')

<div class="page-wrapper">


    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <h2>Task Management</h2>
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
                                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">View</a>
                                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
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
