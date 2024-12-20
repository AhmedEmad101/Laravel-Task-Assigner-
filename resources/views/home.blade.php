<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional Bootstrap Icons (for using icons in navbar) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="Auth.js"></script>
    <script src="AuthData.js"></script>
    <script src="LoginCheck.js"></script>
    <script src="{{asset('logout.js') }}"></script>
    <script src="{{asset('testlogout.js') }}"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Website </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="subscriptions">Subsription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">

                        @Auth
                        <form action="logout" method="post">
                            @csrf
                        <button id="logoutbutton" >Logout</button>
                    </form>
                        @else
                        <form action="logout" method="post">
                            @csrf
                        <button id="logoutbutton" >Logout</button>
                        @endif

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Welcome to Task Assigner , <span id="name"></span></h1>
                <p>This is the home page where you can learn more about us.</p>
                <button class="btn btn-primary" onclick="location.href='team'">Create a team</button>
                <button class="btn btn-primary" onclick="location.href='project'">Create a project</button>
                <button class="btn btn-primary" onclick="location.href='task'">Create a task</button>
                <button class="btn btn-primary" onclick="location.href='send'">Send SMS</button>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card">
                    <img src="tasksimg.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">My Tasks</h5>
                        <p class="card-text">Learn more about our mission and values.</p>
                        <a href="mytasks" class="btn btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card">
                    <img src="projectimg.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">My Projects</h5>
                        <p class="card-text">Explore the services we offer to our clients.</p>
                        <a href="allprojects" class="btn btn-outline-primary">View </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card">
                    <img src="teamimg.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">My Teams</h5>
                        <p class="card-text">Get in touch with us for inquiries and support.</p>
                        <a href="allteams" class="btn btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center p-3 mt-5">
        <p>&copy; 2024 My Website. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS and Popper.js (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
