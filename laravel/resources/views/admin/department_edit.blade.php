@include('layout.dsaha')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Edit Department</h2>

                <!-- Card for editing the department -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Department: {{ $department->name }}</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('departmentsa.update', $department->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Required for form update -->

                            <!-- Department Name -->
                            <div class="form-group">
                                <label for="name">Department Name:</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $department->name }}" required>
                            </div>

                            <!-- Description -->
                            <div class="form-group mt-3">
                                <label for="description">Description:</label>
                                <textarea id="description" name="description" class="form-control">{{ $department->description }}</textarea>
                            </div>

                            <!-- Location Name -->
                            <div class="form-group mt-3">
                                <label for="location_name">Location Name:</label>
                                <input type="text" id="location_name" name="location_name" class="form-control"
                                    value="{{ $department->locations && $department->locations->isNotEmpty() ? $department->locations->first()->name : '' }}" required>
                            </div>

                            <!-- Map -->
                            <div id="map" style="height: 400px; width: 100%;"></div>

                            <!-- Latitude and Longitude -->
                            <div class="form-group mt-3">
                                <label for="latitude">Latitude:</label>
                                <input type="text" id="latitude" name="latitude" class="form-control"
                                    value="{{ $department->locations && $department->locations->isNotEmpty() ? $department->locations->first()->latitude : '' }}" required readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="longitude">Longitude:</label>
                                <input type="text" id="longitude" name="longitude" class="form-control"
                                    value="{{ $department->locations && $department->locations->isNotEmpty() ? $department->locations->first()->longitude : '' }}" required readonly>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-success mt-3">Update Department</button>

                            <!-- Include Google Maps API -->
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXWq0xpCAWzqJNm8gFsvb6qK3XSjwLJ68&callback=initMap" async defer></script>

                            <script>
                                function initMap() {
                                    var initialLat = {{ $department->locations && $department->locations->isNotEmpty() ? $department->locations->first()->latitude : '0' }};
                                    var initialLng = {{ $department->locations && $department->locations->isNotEmpty() ? $department->locations->first()->longitude : '0' }};

                                    var map = new google.maps.Map(document.getElementById('map'), {
                                        center: { lat: initialLat, lng: initialLng },
                                        zoom: 15
                                    });

                                    // Create a new AdvancedMarkerElement
                                    const marker = new google.maps.marker.AdvancedMarkerElement({
                                        position: { lat: initialLat, lng: initialLng },
                                        map: map,
                                        draggable: true
                                    });

                                    // Update latitude and longitude values when the marker is moved
                                    marker.addListener('dragend', function() {
                                        var lat = marker.getPosition().lat();
                                        var lng = marker.getPosition().lng();
                                        document.getElementById('latitude').value = lat;
                                        document.getElementById('longitude').value = lng;
                                    });
                                }

                            </script>
                        </form>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
