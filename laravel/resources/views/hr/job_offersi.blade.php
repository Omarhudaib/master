@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">

    <h2 class="text-center mb-4">Job Offers</h2>
    <a href="{{ route('job_offers.create') }}" class="btn btn-primary mb-3">Create Job Offer</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Company</th>
                <th>Location</th>
                <th>Type</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobOffers as $jobOffer)
                <tr>
                    <td>{{ $jobOffer->id }}</td>
                    <td>{{ $jobOffer->title }}</td>
                    <td>
                        <div style="max-height: 150px; overflow-y: auto; width:100px;">
                            <p style="white-space: nowrap;">{{ $jobOffer->description }}</p>
                        </div>
                    </td>

                    <td>{{ $jobOffer->company }}</td>
                    <td>{{ $jobOffer->location }}</td>
                    <td>{{ $jobOffer->type }}</td>
                    <td>${{ number_format($jobOffer->salary, 2) }}</td>

                    <td>
                        <div class="dropdown sub-dropdown show">
                            <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">

                                <a class="dropdown-item" href="{{ route('job_offers.edit', $jobOffer->id) }}">Update</a>

                                <form action="{{ route('job_offers.destroy', $jobOffer->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>



                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </form>
</div>
</div>
</div>
</div>
@include('layout.Footer')
