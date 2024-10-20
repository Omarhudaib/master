@include('layout.dsaha')


<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">

                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4  class="mb-0">Edit Projects</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('projects.update', $project->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Use PUT or PATCH method for updating resources -->

                            <div class="form-group">
                                <label for="name">Project Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $project->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="3" required>{{ old('description', $project->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="team_id">Assign Team</label>
                                <select name="team_id" class="form-control" id="team_id" required>
                                    <option value="" disabled>Select a team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ $project->team_id == $team->id ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="start_date"
                                       value="{{ old('start_date', optional($project->start_date)->format('Y-m-d')) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date"
                                       value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
