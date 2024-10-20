@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4"> Meetings</h2>

                <!-- Button to create a new meeting -->


                <!-- Card for displaying list of meetings -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Meetings List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Organizer</th>
                                        <th>Manager</th>

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
