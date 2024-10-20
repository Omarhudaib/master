@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Create New Department</h4>
                    </div>
                    <div class="card-body">

                    <h2>Edit Attendance Record</h2>

                    <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="check_in">Check In</label>
                            <input type="datetime-local" class="form-control" id="check_in" name="check_in" value="{{ \Carbon\Carbon::parse($attendance->check_in)->format('Y-m-d\TH:i') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="check_out">Check Out</label>
                            <input type="datetime-local" class="form-control" id="check_out" name="check_out" value="{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('Y-m-d\TH:i') : '' }}">
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
        </div>
    </div>
</div>
</div>@include('layout.Footer')
