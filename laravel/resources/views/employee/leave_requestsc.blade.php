@include('layout.dsah')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <!-- Leave Requests Section -->
        <div class="container">
            <h1 class="mb-4">My Leave Requests</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveRequests as $request)
                        @csrf
                        <tr>
                            <td>{{ $request->leave_type }}</td>
                            <td>{{ $request->start_date }}</td>
                            <td>{{ $request->end_date ?? 'N/A' }}</td>
                            <td>
                                <span class="badge badge-{{ $request->status == 'Approved' ? 'success' : ($request->status == 'Rejected' ? 'danger' : 'warning') }}">
                                    {{ $request->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Leave Request Form Section -->
        <div class="container mt-5">
            <h1 class="mb-4">Create Leave Request</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('leave_requests_create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">Employee</label>
                            <input type="hidden" name="employee_id" id="employee_id" value="{{ auth()->user()->employee->id }}">
                            <input type="text" class="form-control" value="{{ auth()->user()->employee->first_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="leave_type">Leave Type</label>
                            <select name="leave_type" id="leave_type" class="form-control">
                                <option value="Sick">Sick</option>
                                <option value="Vacation">Vacation</option>
                                <option value="Maternity">Maternity</option>
                                <option value="Paternity">Paternity</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
