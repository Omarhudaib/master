@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
    <!-- ============================================================== -->
    <!-- Form for creating a meeting -->
    <!-- ============================================================== -->

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Create New Meeting</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('meetings.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="meeting_date">Meeting Date:</label>
                    <input type="date" id="meeting_date" name="meeting_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" class="form-control">
                </div>

                <div class="form-group">
                    <label for="organizer_id">Organizer:</label>
                    <select id="organizer_id" name="organizer_id" class="form-control" required>
                        @forelse ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                        @empty
                            <option value="">No employees available</option>
                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <label for="manager_id">Manager:</label>
                    <select id="manager_id" name="manager_id" class="form-control">
                        <option value="" style="font-family: 'Courier New', Courier, monospace;">None</option>
                        @forelse ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                        @empty
                            <option value="">No employees available</option>
                        @endforelse
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Meeting</button>
            </form>
        </div>
    </div>
</div>
@include('layout.Footer')
