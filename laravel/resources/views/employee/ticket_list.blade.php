@include('layout.dsah')

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class=" mb-4">Tickets</h2>

                <a href="{{ route('ticketse.create') }}" class="btn btn-primary mb-4">Create New Ticket</a>

                <div class="card shadow-sm">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

        <!-- Start Page Content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Ticket Statistics -->
                        <div class="row">
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-primary text-center">
                                        <h1 class="font-light text-white">{{ $totalTickets }}</h1>
                                        <h6 class="text-white">Total Tickets</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-cyan text-center">
                                        <h1 class="font-light text-white">{{ $respondedTickets }}</h1>
                                        <h6 class="text-white">Responded</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-success text-center">
                                        <h1 class="font-light text-white">{{ $resolvedTickets }}</h1>
                                        <h6 class="text-white">Resolved</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-danger text-center">
                                        <h1 class="font-light text-white">{{ $pendingTickets }}</h1>
                                        <h6 class="text-white">Pending</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tickets Table -->
                        <h4>Tickets</h4>
                        <div class="table-responsive">
                            <table id="ticket_table" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Title</th>
                                        <th>ID</th>
                                        <th>description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->status }}</td>
                                            <td>{{ $ticket->subject }}</td>
                                           <td>{{ $ticket->id }}</td>
                                            <td>{{ $ticket->description }}</td>
                                        <td>{{ $ticket->agent }}</td>
                                            <td>
                                                <form action="{{ route('updateTicket', $ticket->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                        <option value="Open" {{ $ticket->status === 'Open' ? 'selected' : '' }}>Open</option>
                                                        <option value="In Progress" {{ $ticket->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="Closed" {{ $ticket->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                                                    </select>
                                                </form>
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
    <!-- Footer -->
    <footer class="footer text-center text-muted">
        All Rights Reserved by Adminmart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>
</div>

<!-- Scripts -->
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/app-style-switcher.js"></script>
<script src="dist/js/feather.min.js"></script>
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<script src="dist/js/custom.min.js"></script>
<script src="assets/extra-libs/c3/d3.min.js"></script>
<script src="assets/extra-libs/c3/c3.min.js"></script>
<script src="assets/libs/chartist/dist/chartist.min.js"></script>
<script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="dist/js/pages/dashboards/dashboard1.min.js"></script>

</body>

</html>
