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
                                                @if($department->locations && $department->locations->count() > 0)
                                                    @foreach($department->locations as $location)
                                                        {{ $location->latitude }}, {{ $location->longitude }}<br>
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

                    </div></div>
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

                                <!-- Map -->
                                <div id="map" style="height: 400px; width: 100%;"></div>

                                <!-- Latitude and Longitude -->
                                <div class="form-group mt-3">
                                    <label for="latitude">Latitude:</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control" required readonly>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="longitude">Longitude:</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control" required readonly>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-success mt-3">Create Department</button>

                                <!-- Include Google Maps API -->
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXWq0xpCAWzqJNm8gFsvb6qK3XSjwLJ68&callback=initMap" async defer></script>

                                <script>
                                    function initMap() {
                                        // Initialize the map
                                        var map = new google.maps.Map(document.getElementById('map'), {
                                            center: {lat: 0, lng: 0}, // Default center
                                            zoom: 2
                                        });

                                        // Add a marker that users can drag
                                        var marker = new google.maps.Marker({
                                            position: {lat: 0, lng: 0}, // Default position
                                            map: map,
                                            draggable: true
                                        });

                                        // Update latitude and longitude values when the marker is moved
                                        google.maps.event.addListener(marker, 'dragend', function() {
                                            var lat = marker.getPosition().lat();
                                            var lng = marker.getPosition().lng();
                                            document.getElementById('latitude').value = lat;
                                            document.getElementById('longitude').value = lng;
                                        });
                                    }
                                </script>


                                <button type="submit" class="btn btn-success mt-3">Create Department</button>
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
</div>

</div>
@include('layout.Footer')
