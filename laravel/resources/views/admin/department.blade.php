@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Manage Departments</h2>

                <!-- Card for displaying list of departments -->
                <div class="card shadow-sm mt-5">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Departments List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Location (Lat, Long)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{ $department->id }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->description }}</td>
                                        <td>
                                            @if($department->location && $department->location->count() > 0)
                                                @foreach($department->location as $locatio)
                                                    {{ $locatio->latitude }}, {{ $locatio->longitude }}<br>
                                                @endforeach
                                            @else
                                                No location available
                                            @endif
                                        </td>
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
                                                    <!-- Edit Option -->
                                                    <a class="dropdown-item" href="{{ route('departmentsa.edit', $department->id) }}">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Card for creating new department -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Create New Department</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('departmentsd.create') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Department Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="description">Description:</label>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>

                            <!-- Location fields -->
                            <div class="form-group mt-3">
                                <label for="location_name">Location Name:</label>
                                <input type="text" id="location_name" name="location_name" class="form-control" required>
                            </div>

                            <!-- Latitude and Longitude -->
                            <div class="form-group mt-3">
                                <label for="latitude">Latitude:</label>
                                <input type="text" id="latitude" name="latitude" class="form-control" required readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="longitude">Longitude:</label>
                                <input type="text" id="longitude" name="longitude" class="form-control" required readonly>
                            </div>

                            <!-- Button to get location -->
                            <button type="button" id="getLocationBtn" class="btn btn-primary mt-3">Get Current Location</button>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-success mt-3">Create Department</button>

                            <!-- Geolocation Script -->
                            <script>
                                document.getElementById('getLocationBtn').addEventListener('click', function() {
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(function(position) {
                                            document.getElementById('latitude').value = position.coords.latitude;
                                            document.getElementById('longitude').value = position.coords.longitude;
                                        }, function(error) {
                                            alert('Unable to retrieve your location');
                                        });
                                    } else {
                                        alert('Geolocation is not supported by this browser.');
                                    }
                                });
                            </script>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.Footer')
