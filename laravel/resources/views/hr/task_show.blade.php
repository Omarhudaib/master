@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h2 class="text-center">Your Tasks</h2>
        <div class="card">
            <div class="card-body">
                @if($tasks->isEmpty())
                    <p>No tasks assigned to you.</p>
                @else
                <table class="table table-bordered">

                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th> <!-- Added Action column -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->due_date }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td>
                                        <!-- Status Update Form -->
                                        <form action="{{ route('tasksh.updateStatus', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PUT') <!-- Use PUT for update -->
                                            <select name="status" onchange="this.form.submit()">
                                                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
