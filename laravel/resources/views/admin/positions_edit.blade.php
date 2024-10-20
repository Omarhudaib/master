@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Manage Position</h2>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form for Editing the Position -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Position</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('positions.update', $position->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Select Department -->
                    <div class="form-group">
                        <label for="department_id">Department:</label>
                        <select id="department_id" name="department_id" class="form-control" required>
                            <option value="">Select a department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $position->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Position Title -->
                    <div class="form-group">
                        <label for="title">Position Title:</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $position->title) }}" required>
                    </div>

                    <!-- Position Description -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control">{{ old('description', $position->description) }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Position</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layout.Footer')
