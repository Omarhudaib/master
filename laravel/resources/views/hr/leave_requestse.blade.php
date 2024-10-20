@include('layout.dsahh')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <h2>All Requests</h2>
                <h1>Leave Requests</h1>
                <a href="{{ route('leave_requestsc') }}" class="btn btn-primary mb-3">Create Leave Request</a>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveRequest as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->employee->user->name }}</td>
                                <td>{{ $request->leave_type }}</td>
                                <td>{{ $request->start_date }}</td>
                                <td>{{ $request->end_date ?? 'N/A' }}</td>
                                <td>{{ $request->status }}</td>
                                <td>
                                    <a href="{{ route('leave_requestse', $request->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('leave_requestsd', $request->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
</div>
</div>
</div>@include('layout.Footer')
