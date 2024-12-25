<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects List</title>
    <link rel="stylesheet" href="projectstyle.css">
</head>
<script>
    window.onload = function(){
        document.getElementById("User_ID").value = userId;
    }
</script>
<body>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="home">Home</a>
    </li>
    <div class="container">
        <h1 class="page-title">Teams List</h1>
@foreach ($PfTeams as $t)


        <div class="projects-list">
            <!-- Example of a single project entry -->
            <div class="project-item">
                <h3 class="project-name">{{$t->name}}</h3>
                <p class="project-description"> Team Leader ID {{$t->leader_Id}}</p>
                <p class="project-description">Team Member ID {{$t->member_id}}</p>
                <div class="project-actions">
                    <form  action="toteammember" method="GET">
                        @csrf
                        <input type="hidden" name="Leader_ID"  value="{{$t->leader_Id}}">
                        <input type="hidden" name="Team_ID"  value="{{$t->id}}">
                        <input type="hidden" name="Team_Name"  value="{{$t->name}}">
                    <button class="edit-btn"  onclick="">Add a member</button>
                </form>
                    <button class="edit-btn">Edit</button>
                    <form id ="delete-form" action="delete/{{$t->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button class="delete-btn"  onclick="confirmDelete({{ $t->id }})">Delete</button>
                </form>

                </div>
                <script>
                    function confirmDelete(projectId) {
                        // Show a confirmation dialog before submitting the form
                        if (confirm('Are you sure you want to delete this project? This action cannot be undone.')) {
                            // If confirmed, submit the form
                            document.getElementById('delete-form' + projectId).submit();
                        }
                    }
                </script>
            </div>

            <!-- Example of another project entry -->


            <!-- Add more projects dynamically with foreach in Laravel -->
            @endforeach
        </div>
    </div>

</body>
</html>
