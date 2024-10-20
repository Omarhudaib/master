@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Manage Meetings</h2>

                <!-- Button to create a new meeting -->
                <div class=" mb-3">
                    <a href="{{ route('meetings.create') }}" class="btn btn-primary">Create New Meeting</a>
                </div>

                <!-- Card for displaying list of meetings -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Meetings List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Organizer</th>
                                        <th>Manager</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->subject }}</td>
                                        <td>{{ \Carbon\Carbon::parse($meeting->meeting_date)->format('Y-m-d') }}</td>

                                        <td>{{ $meeting->location }}</td>
                                        <td>{{ $meeting->organizer->first_name }}</td>
                                        <td>{{ $meeting->manager ? $meeting->manager->first_name : 'N/A' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <!-- View Option -->
                                                    <a class="dropdown-item" href="{{ route('meetings.show', $meeting->id) }}">View</a>

                                                    <!-- Edit Option -->
                                                    <a class="dropdown-item" href="{{ route('meetings.edit', $meeting->id) }}">Edit</a>

                                                    <!-- Delete Option -->
                                                    <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
