@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row col-md-12">
            <h2 class="text-center mb-4">Task Details</h2>
        </div>
            <div class="row">
            <div class="card col-md-12">
                <div class="card-body">
                    <h4>Task: {{ $task->title }}</h4>
                    <p><strong>Project:</strong> {{ $task->project->name ?? 'N/A' }}</p>
                    <p><strong>Employee:</strong> {{ $task->employee->first_name ?? 'N/A' }} {{ $task->employee->last_name ?? 'N/A' }}</p>
                    <p><strong>Description:</strong> {{ $task->description ?? 'N/A' }}</p>
                    <p><strong>Due Date:</strong> {{ $task->due_date ? $task->due_date: 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $task->status }}</p>


                    <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Task</button>
                    </form>

                    <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back to Task List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
