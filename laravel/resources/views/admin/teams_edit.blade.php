@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Edit Team</h2>

                <!-- Card for editing the team -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Team Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('teams.update', $team->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $team->name }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="team_leader_id">Team Leader:</label>
                                <select name="team_leader_id" id="team_leader_id" class="form-control" required>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $team->team_leader_id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="department_id">Department:</label>
                                <select name="department_id" id="department_id" class="form-control" required>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $team->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{ $team->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update Team</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
