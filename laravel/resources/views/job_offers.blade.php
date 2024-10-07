<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="HR and Employee Relations System - Streamline employee management and communication.">
    <meta name="author" content="Your Company">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Job Offers - HR & ER System</title>

    <!-- Custom CSS -->
    <link href="{{ asset('assets/libs/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('career') }}">Career</a>
                </li>
                <!-- Add other navigation items as needed -->
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Job Offers</h1>
        <div class="row">
            @forelse($jobOffers as $offer)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $offer->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $offer->department }}</h6>
                            <p class="card-text">{{ $offer->description }}</p>
                            <p><strong>Salary:</strong> {{ $offer->salary }}</p>
                            <p><strong>Location:</strong> {{ $offer->location }}</p>
                            <p><strong>Posted On:</strong> {{ \Carbon\Carbon::parse($offer->created_at)->format('M d, Y') }}</p>
                            <!-- Apply Button -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#applyModal{{ $offer->id }}">Apply</button>
                        </div>
                    </div>
                </div>

                <!-- Modal for Application Form -->
                <!-- Modal for Application Form -->
                <div class="modal fade" id="applyModal{{ $offer->id }}" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel{{ $offer->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="applyModalLabel{{ $offer->id }}">Apply for {{ $offer->title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('job.apply', $offer->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="resume">Upload Resume</label>
                                        <input type="file" class="form-control-file" id="resume" name="resume" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cover_letter">Cover Letter</label>
                                        <textarea class="form-control" id="cover_letter" name="cover_letter" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Application</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="alert alert-info text-center" role="alert">
                    No job offers available at this time.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>