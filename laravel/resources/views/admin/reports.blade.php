@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Employee Monthly Report</h2>

                <button class="btn btn-secondary mb-3" onclick="printDiv('printable-area')">Print Report</button>

                <div class="card shadow-sm">
                    <div id="printable-area">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Employee Report</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Total Hours</th>
                                        <th>Salary per Hour</th>
                                        <th>Total Salary</th>
                                        <th>Deduction Amount (7.25%)</th>
                                        <th>Adjusted Salary</th>
                                        <th>Final Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monthlyData as $data)
                                        <tr>
                                            <td>{{ $data['name'] }} {{ $data['namel'] }}</td>
                                            <td>{{ $data['department'] }}</td>
                                            <td>{{ $data['total_hours'] }}</td>
                                            <td>{{ number_format($data['salary_per_hour'], 2) }}</td>
                                            <td>{{ number_format($data['total_salary'], 2) }}</td>
                                            <td>{{ number_format($data['deduction_amount'], 2) }}</td>
                                            <td>{{ number_format($data['adjusted_salary'], 2) }}</td>
                                            <td>{{ number_format($data['final_salary'], 2) }}</td>
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
<script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>


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
