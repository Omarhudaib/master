@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Manage Departments</h2>

                <!-- Card for managing departments -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Departments</h4>
                    </div>
                    <div class="card-body">
                        @if($departments->isNotEmpty())
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Department Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $department)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>
                                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline-block">
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
                            <p>No departments found.</p>
                        @endif
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('departments.create') }}" class="btn btn-primary">Add New Department</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
