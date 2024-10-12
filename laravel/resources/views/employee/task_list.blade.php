@include('layout.dsah')

<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="col-md-12">
    <h2 class=" mb-4">Tasks</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Ticket Statistics -->
                        <div class="row">
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-primary text-center">
                                        <h1 class="font-light text-white">{{ $totalTask }}</h1>
                                        <h6 class="text-white">Total Tasks</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-cyan text-center">
                                        <h1 class="font-light text-white">{{ $respondedTasks }}</h1>
                                        <h6 class="text-white">In Progress</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-success text-center">
                                        <h1 class="font-light text-white">{{ $resolvedTasks }}</h1>
                                        <h6 class="text-white">Resolved</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="p-2 bg-danger text-center">
                                        <h1 class="font-light text-white">{{ $pendingTasks }}</h1>
                                        <h6 class="text-white">Pending</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks Table -->
                        <h4>Tasks</h4>
                        <div class="table-responsive">
                            <table id="task_table" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Title</th>
                                        <th>Employee</th>
                                        <th>Description</th>
                                        <th>Project Id</th>
                                        <th>Due Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr>



                                            <td>{{ $task->status }}</td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->employee_id }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td>{{ $task->project_id }}</td>
                                            <td>{{ $task->due_date }}</td>
                                            <td>
                                                <form action="{{ route('updateTask', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                        <option value="In Progress" {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
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
