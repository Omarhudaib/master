@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">

                    <div class="card-body">
                <h2 class="text-center mb-4">Job Requests</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Job Offer</th>
                            <th>Cover Letter</th>
                            <th>Resume</th> <!-- New column for Resume -->
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->user->email }}</td>
                                <td>{{ $request->jobOffer->title }}</td>
                                <td>{{ $request->cover_letter }}</td>
                                <td>
                                    @if($request->resume_path)
                                        <a href="{{ Storage::url($request->resume_path) }}" download class="btn btn-success btn-sm">Download Resume</a>
                                    @else
                                        <span>No Resume Uploaded</span>
                                    @endif
                                </td>


                                <td>{{ $request->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No job requests available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
