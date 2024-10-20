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
                            @method('PUT')

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

                            <!-- Button to get current location -->
                            <button type="button" id="getLocationBtn" class="btn btn-primary mt-3">Get Current Location</button>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-success mt-3">Update Department</button>
                        </form>

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
