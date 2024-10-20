@include('layout.dsaha')

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Form for creating a meeting -->
    <!-- ============================================================== -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Create New Meeting
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
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->first_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="manager_id">Manager:</label>
                        <select id="manager_id" name="manager_id" class="form-control">
                            <option value="">N/A</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->first_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
