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
                                    <th>Check Out</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee->dailyInOut as $attendance)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($attendance->check_in)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i:s') }}</td>
                                    <td>{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i:s') : 'N/A' }}</td>

                                    <!-- Display Location Name -->
                                    <td>
                                        @if($attendance->employee && $attendance->employee->department)
                                            @php
                                                $locations = $attendance->employee->department->location; // Assuming this is a collection
                                            @endphp
                                            @if($locations->isNotEmpty())
                                                {{ $locations->first()->name }}  <!-- Get the first location's name -->
                                            @else
                                                <p>No Location Available</p>
                                            @endif
                                        @else
                                            <p>No Location Available</p>
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
    </div>
</div>
