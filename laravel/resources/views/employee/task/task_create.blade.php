@include('layout.dsah')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add Task</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('taskse.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="project_id">Project:</label>
                                <select name="project_id" id="project_id" class="form-control" required>
                                    <option value="" disabled selected>Select a project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" data-team="{{ $project->team->id }}">
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="employee_id">Employee:</label>
                                <select name="employee_id" id="employee_id" class="form-control" required>
                                    <option value="" disabled selected>Select an employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if($team)
                                <input type="hidden" name="team_id" id="team_id" value="{{ $team->id }}">
                            @else
                                <input type="hidden" name="team_id" id="team_id" value="">
                                <p class="text-danger">You are not part of any team.</p>
                            @endif
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="due_date">Due Date:</label>
                                <input type="date" name="due_date" id="due_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('project_id').addEventListener('change', function () {
        const projectId = this.value;
        const employeeSelect = document.getElementById('employee_id');
        const options = employeeSelect.options;
        // Reset employee selection
        employeeSelect.selectedIndex = 0;
        // Show only employees related to the selected project
        for (let i = 0; i < options.length; i++) {
            options[i].style.display = 'block';  // Ensure all employees can be seen in this case
        }
    });
</script>
</div>

@include('layout.Footer')
