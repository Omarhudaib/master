@include('layouts.dash')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit Task</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('taskse.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="project_id">Project:</label>
                <select name="project_id" id="project_id" class="form-control" required>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id" class="form-control" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->first_name }} {{ $employee->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="team_id">Team:</label>
                <select name="team_id" id="team_id" class="form-control" required>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ $task->team_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
</div>

    $(document).ready(function() {
        $('#project_id').change(function() {
            var projectId = $(this).val();
            // Clear the employee dropdown
            $('#employee_id').html('<option value="" disabled selected>Select an employee</option>');
            if (projectId) {
                $.ajax({
                    url: '{{ url('fetch-employees') }}/' + projectId,
                    type: 'GET',
                    success: function(response) {
                        $.each(response.employees, function(key, employee) {
                            $('#employee_id').append('<option value="'+employee.id+'">'+employee.first_name+' '+employee.last_name+'</option>');
                        });
                    }
                });
            }
        });
    });
</script>
@include('layout.Footer')
