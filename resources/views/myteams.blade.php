<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams List</title>
    <link rel="stylesheet" href="projectstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script>
    window.onload = function(){
        document.getElementById("User_ID").value = userId;
    }
</script>
<body>
    <li class="nav-item">
        <form action="home" method="GET">
            @csrf
        <button id="" >home</button>

    </form>
    </li>
    <div class="container">
        <h1 class="page-title">Teams List</h1>

        @if (session('Success_add_member'))
        <div class="alert alert-success">
        {{session('Success_add_member')}}
    </div>
        @endif


            @if (session('team_deleted'))
            <div class="alert alert-success">
            {{session('team_deleted')}}
        </div>
            @endif

                @if (session('Failed_add_member'))
                <div class="alert alert-danger">
                {{session('Failed_add_member')}}
            </div>
                @endif

@foreach ($PfTeams as $teamName => $teams)

{{$x = 0}}
        <div class="projects-list">

            <div class="project-item">
                <h3 class="project-name">Team : {{$teamName}}</h3>

              <p class="project-description"> Team Leader ID {{$teams[$x]->leader_Id}}</p>
              <div class="project-actions">
                <form  action="toteammember" method="GET">
                    @csrf
                    <input type="hidden" name="Leader_ID"  value="{{$teams[$x]->leader_Id}}">
                    <input type="hidden" name="Team_ID"  value="{{$teams[$x]->id}}">
                    <input type="hidden" name="Team_Name"  value="{{$teams[$x]->name}}">
                <button class="edit-btn"  onclick="">Add a member</button>
            </form>
                <button class="edit-btn">Edit</button>
                <form id ="delete-form" action="DeleteTeam/{{$teams[$x]->id}}" method="POST">
                    @method('DELETE')
                    @csrf
                <button class="delete-btn"  onclick="confirmDelete({{ $teams[$x]->id }})">Delete</button>
            </form>


            </div>
             @foreach ($teams as $team)
           @if($team->member_id != $team->leader_Id)
                <p class="project-description">Team Member ID {{$team->member_id}}</p>
@endif
                @endforeach

            </div>

            <!-- Example of another project entry -->

{{$x++;}}
            <!-- Add more projects dynamically with foreach in Laravel -->
            @endforeach
        </div>
    </div>
    <script>
        function confirmDelete(team) {
            // Show a confirmation dialog before submitting the form
            if (confirm('Are you sure you want to delete this team? This action cannot be undone.')) {
                // If confirmed, submit the form
                document.getElementById('delete-form' + team).submit();
            }
            else{event.preventDefault();}
        }
    </script>
</body>
</html>
