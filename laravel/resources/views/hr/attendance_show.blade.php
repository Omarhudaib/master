@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Attendance Records</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Check In</th>
                                    <th>Location In</th>
                                    <th>Check Out</th>
                                    <th>Location Out</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee->dailyInOut as $attendance)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($attendance->check_in)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i:s') }}</td>

                                    <!-- Map for Check In Location -->
                                    <td>
                                        @if($attendance->locationIn)
                                            <div id="mapIn-{{ $attendance->id }}" style="width: 100%; height: 200px;"></div>
                                            <script>
                                                var mapIn = L.map('mapIn-{{ $attendance->id }}').setView([{{ $attendance->locationIn->latitude }}, {{ $attendance->locationIn->longitude }}], 13);
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    maxZoom: 19,
                                                }).addTo(mapIn);
                                                L.marker([{{ $attendance->locationIn->latitude }}, {{ $attendance->locationIn->longitude }}]).addTo(mapIn);
                                            </script>
                                        @else
                                            <p>No Check In Location</p>
                                        @endif
                                    </td>

                                    <td>{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i:s') : 'N/A' }}</td>

                                    <!-- Map for Check Out Location -->
                                    <td>
                                        @if($attendance->locationOut)
                                            <div id="mapOut-{{ $attendance->id }}" style="width: 100%; height: 200px;"></div>
                                            <script>
                                                var mapOut = L.map('mapOut-{{ $attendance->id }}').setView([{{ $attendance->locationOut->latitude }}, {{ $attendance->locationOut->longitude }}], 13);
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    maxZoom: 19,
                                                }).addTo(mapOut);
                                                L.marker([{{ $attendance->locationOut->latitude }}, {{ $attendance->locationOut->longitude }}]).addTo(mapOut);
                                            </script>
                                        @else
                                            <p>No Check Out Location</p>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('attendance.edit', $attendance->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layout.Footer')
