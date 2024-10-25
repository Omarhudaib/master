@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-4">Employee Attendance</h1>
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Employee Attendance</h4>
                    </div>
                    <div class="card-body">
                        <!-- Search Input -->
                        <div class="mb-3">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search Employee..." onkeyup="searchTable()">
                        </div>

                        <div class="table-responsive"> <!-- Make table responsive for smaller screens -->
                            <table class="table table-bordered table-striped" id="attendanceTable">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employees as $employee) <!-- Use forelse to handle empty data -->
                                        <tr>
                                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                            <td>
                                                <a href="{{ route('attendance.show', $employee->id) }}" class="btn btn-info btn-sm">Show Daily In/Out</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">No employees found.</td> <!-- Message for no employees -->
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> <!-- End of table-responsive -->
                    </div> <!-- End of card-body -->
                </div> <!-- End of card -->
            </div> <!-- End of col-md-12 -->
        </div> <!-- End of row -->
    </div> <!-- End of page-breadcrumb -->
</div> <!-- End of page-wrapper -->

@include('layout.Footer')

<script>
    function searchTable() {
        // Get the input value and convert it to lowercase
        const input = document.getElementById('searchInput').value.toLowerCase();
        const table = document.getElementById('attendanceTable');
        const rows = table.getElementsByTagName('tr');

        // Loop through all rows (starting from index 1 to skip header)
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            // Loop through the cells in the current row
            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];

                if (cell) {
                    // Check if the cell contains the search term
                    if (cell.textContent.toLowerCase().includes(input)) {
                        found = true; // Mark that we found a match
                        break; // No need to check further cells in this row
                    }
                }
            }

            // Show or hide the row based on search result
            rows[i].style.display = found ? '' : 'none';
        }
    }
</script>
