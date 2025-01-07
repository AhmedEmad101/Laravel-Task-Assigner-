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
    <style> body {
        background-color: #11fe6c;
         /* Light blue */
    }</style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="Auth.js"></script>
    <script src="AuthData.js"></script>
    <script src="LoginCheck.js"></script>
    <script src="{{asset('testlogout.js') }}"></script>
    <script> window.onload = function() {
        document.getElementById("Creatorid").value = userId;
        document.getElementById("Authorid").value = userId;
        document.getElementById("TaskCreator").value = userId;
        document.getElementById("Assignmentorid").value = userId;
        document.getElementById("SubId").value = userId
        document.getElementById("ContactorId").value = userId
      };  </script>

</head>
<body>
    @if (session('task_created'))

    {{session('task_created')}}


    @endif
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Task Assginer --> Welcome <span id="email"></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="home" method="GET">
                            @csrf
                        <button id="" >home</button>

                    </form>
                    </li>
                    <li class="nav-item">
                        <form action="subscriptions" method="GET">
                            @csrf
                            <input type="hidden" name="SubId" id="SubId">
                        <button id="" >Subscriptions</button>

                    </form>
                    </li>
                    <li class="nav-item">
                        <form action="about" method="GET">
                            @csrf
                        <button id="" >about</button>

                    </form>
                    </li>
                    <li class="nav-item">
                        <form action="Contactindex" method="GET">
                            @csrf
                            <input type="hidden" name="Contactor" id="ContactorId">
                        <button id="" >Contact</button>

                    </form>
                    </li>
                    <li class="nav-item">


                        <form action="logout" method="post">
                            @csrf
                        <button id="logoutbutton" >Logout</button>

                    </form>




                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <div><h1>Welcome to Task Assigner , <span id="name"></span></h1></div><div> <img id ="SubscriptionImg" src="" width="100" height="100"></div>
                <span id="expires_at"></span>
                <p>This is the home page where you can learn more about us.</p>
                <button class="btn btn-primary" onclick="location.href='team'">Create a team</button>
                <button class="btn btn-primary" onclick="location.href='project'">Create a project</button>
                <button class="btn btn-primary" onclick="location.href='send'">Send SMS</button>
            </div>
            @if (session('success-addteam'))
                <div class="alert alert-success">
                    {{session('success-addteam')}}
                </div>
            @endif
        </div>

        <div class="row mt-4">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card">
                    <img src="task.png" class="card-img-top" alt="..." width="200" height="240">
                    <div class="card-body">
                        <h5 class="card-title">My Tasks</h5>


                        <form action="mytasks" method="GET">
                            @csrf
                            <input type="hidden" name="TaskCreator" id="TaskCreator">
                        <button class="btn btn-outline-primary" type="submit">View </button> <span id="alertBadge" class="badge" > @if (session('task_created'))
                           <div style="background-color: red"> <p>+1 here</p></div>
                            @endif</span>

                    </form>
                    <form action="workon" method="get">@csrf
                        <input type="hidden" name="Assignment" id="Assignmentorid">
                        <button class="btn btn-outline-primary" type="submit">Assignments </button>
                    </form>
                    <p class="card-text">All the users that you assigned tasks to them here.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card">
                    <img src="projectimg.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">My Projects</h5>
                        <p class="card-text">Explore the services we offer to our clients.</p>
                        <form action="allmyprojects" method="GET">
                            @csrf
                            <input type="hidden" name="Authorid" id="Authorid">
                        <button class="btn btn-outline-primary" type="submit">View </button>
                        <span id="" class="" > @if (session('project_created'))
                            <div style="background-color: red"> <p>+1 here</p></div>
                             @endif</span>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card">
                    <img src="teamimg.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">My Teams</h5>
                        <p class="card-text">Get in touch with us for inquiries and support.</p>
                        <form action="allmyteams" method="GET">
                            @csrf
                            <input type="hidden" name="CreatorID" id="Creatorid">
                        <button class="btn btn-outline-primary" type="submit">View </button>
                    </form>
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
    <script src="{{asset('logout.js') }}"></script>
<script>
var SubImg = document.getElementById('SubscriptionImg');
var expires_at_date = document.getElementById('expires_at');
fetch(`api/tier/${userId}`, {
    method: 'GET', // You are fetching data, so 'GET' is appropriate
    headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',

    },
})
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json(); // Parse the JSON response
    })
    .then(data => {
        if (data.subscriptionName === 404) {
            SubImg.style.display = 'none';
            console.error('Subscription tier not found.');
        } else {
           switch(data.subscriptionName)
           {
            case 'gold':SubImg.src ='Gold-Icon.jpg';break;
            case 'silver':SubImg.src = 'silvericon.png';break;
            case 'bronze':SubImg.src ='Bronze-Icon-1.jpg';break
           } // Handle the subscription tier name
           expires_at_date.innerText = data.subscriptionName +' membership expires at '+data.expires_at;
           expires_at_date.style.fontWeight = 'bold';
        }
    })
    .catch(error => {
        SubImg.style.display = 'none';
        console.error('Error fetching subscription:', error);
    });
</script>

</body>
</html>
