@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Manage Positions</h2>

                <!-- Card for managing positions -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Positions</h4>
                    </div>
                    <div class="card-body">
                        @if($positions->isNotEmpty())
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Position Title</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($positions as $position)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $position->title }}</td>
                                        <td>
                                            <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline-block">
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
                            <p>No positions found.</p>
                        @endif
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('positions.create') }}" class="btn btn-primary">Add New Position</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
