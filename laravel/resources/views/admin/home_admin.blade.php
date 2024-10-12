@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <!-- Check-in Reminder -->
        @if($canCheckIn)
            <div class="alert alert-warning text-center">
                You haven't checked in yet. Please check in to start your day.
            </div>
        @endif

        <div class="row">
            <!-- Check-in Button -->
            <form action="{{ route('daily_in_out.checkIn') }}" method="POST" class="mr-2">
                @csrf
                <button type="submit" class="btn btn-primary" id="checkInButton" {{ $canCheckIn ? '' : 'disabled' }}>Check In</button>
            </form>

            <!-- Check-out Button -->
            @if($canCheckOut)
                <form action="{{ route('daily_in_out.checkOut') }}" method="POST" class="mr-2">
                    @csrf
                    <button type="submit" class="btn btn-danger" id="checkOutButton">Check Out</button>
                </form>
            @endif
        </div>
    </div>

    <!-- Dashboard Summary Section -->
    <div class="container-fluid">
        <div class="row">
            <!-- Summary Cards -->
            @foreach ([
              ['Total Employees', $totalEmployees, 'bg-primary'], // Blue
    ['Total Projects', $totalProjects, 'bg-success'], // Green
    ['Total Tasks', $totalTasks, 'bg-warning'], // Yellow
    ['Total Departments', $totalDepartments, 'bg-info'], // Light Blue
    ['Leave Requests', $totalLeaveRequests, 'bg-danger'], // Red
    ['Active Projects', $activeProjects, 'bg-dark'], // Dark
    ['Done Projects', $doneProjects, 'bg-secondary'], // Gray
    ['Planned Projects', $plannedProjects, 'bg-success'], // Light Gray
    ['Total Check-Ins', $totalCheckIns, 'bg-purple'], // Purple
    ['Pending Tasks', $pendingTasks, 'bg-orange'], // Orange
    ['Meetings', $meetings, 'bg-info'], // Teal
    ['Pending Tickets', $pendingTicket, 'bg-warning'], // Pink
            ] as [$title, $count, $bgClass])
                <div class="col-md-3 mt-3">
                    <div class="card card-hover">
                        <div class="p-2 {{ $bgClass }} text-center">
                            <h4 class="font-light text-white">{{ $count }}</h4>
                            <h6 class="text-white">{{ $title }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
<!-- Teams Section -->
<div class="row mt-4">
    <div class="col-md-12">
        <h2>Teams</h2>
   <div class="table-responsive">
        <table class="table table-hover table-warning">
            <thead class="bg-warning text-white">
                    <tr>
                        <th>Team Name</th>
                        <th>Team Leader</th>
                        <th>Project Name</th>
                        <th>End Date</th>
                        <th>Employees</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->leader->name ?? 'No leader assigned' }}</td>
                            <td>{{ $team->projects->isNotEmpty() ? $team->projects->first()->name : 'No projects' }}</td>
                            <td>{{ $team->projects->isNotEmpty() ? $team->projects->first()->end_date: 'N/A' }}</td>
                            <td>{{ $team->employees->isNotEmpty() ? $team->employees->count() : 'No employees' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
 </div>
    <!-- Posts Section -->
    <div class="col-md-12">
        <h2>Recent Posts</h2>
        <p class="text-muted">Stay updated with the latest posts from your team.</p>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-info text-white">
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                              {{ $post->title }}
                            </td>
                            <td>{{ $post->user->name ?? 'Unknown' }}</td>
                            <td>{{ $post->content}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="mt-2">
            {{ $posts->links() }}
        </div>
    </div>
</div>

    </div>
</div>


<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dist/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
