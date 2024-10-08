<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="HR and Employee Relations System - Streamline employee management and communication.">
    <meta name="author" content="Your Company">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>HR & ER System - Empower Your Workforce</title>

    <!-- Custom CSS -->
    <link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

    <style>
        body {
            color: #333; /* Darker text color */
        }

        /* Header styles */
        .header {
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('assets/images/background/home.jpg') }}');
            background-size: cover;
            background-position: left;
            height: 85vh; /* Full viewport height */
            display: flex;
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            color: #fff; /* Text color for better contrast */
        }

        .header h1,
        .header p {
            text-align: left; /* Align text to the left */
            margin: 0; /* Remove default margins */
        }

        .content-section img {
            width: 100%; /* Full width */
            height: auto; /* Maintain aspect ratio */
            max-height: 200px; /* Uniform max height */
            object-fit: cover; /* Cover without distortion */
            margin-bottom: 15px; /* Space below the image */
        }

        .content-section {
            min-height: 300px; /* Ensure sections have minimum height */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
        }

        /* Align text to the left */
        .feature-text {
            text-align: left;
            margin-top: 15px; /* Space above the text */
        }
    </style>
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
            </ul>
        </div>
    </nav>
    <hr style="padding: 0;  margin: 0;">

    <!-- Header with Background Image -->
    <div class="header">
        <div>
            <h1 class="display-4">Welcome to Our Website</h1>
            <p class="lead">Our platform simplifies employee management, task assignments, and improves communication between employees and management.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
        </div>
    </div>

    <div class="container mt-5">
        <div class="content-section h-90">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/feature1.png') }}" alt="Feature 1" class="img-fluid">
                    <h3 class="feature-text">Employee Management</h3>
                    <p class="feature-text">Manage employee records, teams, and tasks effortlessly. Our system offers powerful tools to track and optimize your workforce.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/feature2.png') }}" alt="Feature 2" class="img-fluid">
                    <h3 class="feature-text">Task Assignment & Monitoring</h3>
                    <p class="feature-text">Assign tasks to employees and teams, track their progress, and ensure timely completion with real-time status updates and notifications.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/feature3.png') }}" alt="Feature 3" class="img-fluid">
                    <h3 class="feature-text">Employee Relations</h3>
                    <p class="feature-text">Build strong relationships between employees and management. Easily manage employee requests, relations, and resolve concerns.</p>
                </div>
            </div>
        </div>

        <div class="content-section">
            <div class="row">
                <div class="col-md-6">
                    <h3>About Our System</h3>
                    <p>Our HR & ER System is designed to improve the workflow in your organization by offering a range of tools to manage everything from employee onboarding to performance tracking. We provide a unified platform where HR teams can collaborate seamlessly with management to ensure the success of your employees.</p>
                </div>
                <div class="col-md-6">
                    <h3>Why Choose Us?</h3>
                    <ul>
                        <li>Easy-to-use interface for employees and management.</li>
                        <li>Comprehensive tools for HR management and employee relations.</li>
                        <li>Real-time tracking and performance monitoring.</li>
                        <li>Secure data management and privacy protection.</li>
                        <li>Scalable for businesses of all sizes.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p>Ready to enhance your HR processes? <a href="contact.html">Contact us</a> for a demo or to learn more!</p>
        </div>
    </div>

    <!-- Scripts -->
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

</body>

</html>
