@include('layout.dsahh')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <h2>All Requests</h2>
                <!-- Table Layout for Larger Screens -->
                <div class="d-none d-md-block">
                    <table class="table table-bordered shadow">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Employee</th>
                                <th>Request Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                            <tr>
                                <td>{{ $request->employee->first_name ?? 'N/A' }} {{ $request->employee->last_name ?? 'N/A' }}</td>
                                <td>{{ $request->request_type }}</td>
                                <td>{{ $request->description ?? 'N/A' }}</td>
                                <td>
                                    <form action="{{ route('requestsh.updateStatus', $request->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approved" {{ $request->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="Rejected" {{ $request->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('requestsh.destroy', $request->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Card Layout for Smaller Screens -->
                <div class="d-md-none">
                    @foreach($requests as $request)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $request->employee->first_name ?? 'N/A' }} {{ $request->employee->last_name ?? 'N/A' }}</h5>
                            <p class="card-text">
                                <strong>Request Type:</strong> {{ $request->request_type }}<br>
                                <strong>Description:</strong> {{ $request->description ?? 'N/A' }}<br>
                                <strong>Status:</strong>
                                <form action="{{ route('requestsh.updateStatus', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" {{ $request->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Rejected" {{ $request->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            </p>
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('requestsh.destroy', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include your JavaScript files as needed -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dist/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<!-- Custom JavaScript -->
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<!-- This page JavaScript -->
<script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
