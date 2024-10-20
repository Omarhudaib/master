@include('layout.dsaha')


<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Create Ticket</h2>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('tickets.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="employee_id">Employee:</label>
                                <select name="employee_id" id="employee_id" class="form-control" required>
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="subject">Subject:</label>
                                <input type="text" name="subject" id="subject" class="form-control" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Open">Open</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Create Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@include('layout.Footer')
