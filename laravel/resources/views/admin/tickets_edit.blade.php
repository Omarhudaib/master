@include('layout.dsaha')


<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class=" mb-4">Edit Ticket</h2>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('tickets.update', $ticket) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="employee_id">Employee:</label>
                                <select name="employee_id" id="employee_id" class="form-control" required>
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $employee->id == $ticket->employee_id ? 'selected' : '' }}>
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="subject">Subject:</label>
                                <input type="text" name="subject" id="subject" class="form-control" value="{{ $ticket->subject }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{ $ticket->description }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                                    <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Update Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

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

</body>
</html>
