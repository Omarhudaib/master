@include('layout.dsahh')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12"> <h1 class="text-center mb-4">Leave Requests</h1>
                <div class="card shadow-sm">
                  <div class="card-header bg-primary text-white">
   <h4 class="mb-0">All Requests</h4>
                    </div>
                    <div class="card-body">


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
                            <th>Sick Leaves</th>
                            <th>Annual Vacation Days</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveRequests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->employee->user->name ?? 'Unknown Employee' }}</td>
                            <td>{{ $request->leave_type }}</td>
                            <td>{{ $request->start_date }}</td>
                            <td>{{ $request->end_date ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('leave_request_update_status', $request->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" {{ $request->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Rejected" {{ $request->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                {{ $request->employee->sick_leaves - ($request->status == 'Approved' ? $request->leave_days : 0) }}
                            </td>
                            <td>
                                {{ $request->employee->annual_vacation_days - ($request->status == 'Approved' ? $request->vacation_days : 0) }}
                            </td>
                            <td>
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
</div>

</div>@include('layout.Footer')
