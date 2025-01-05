<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks List</title>
    <link rel="stylesheet" href="projectstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="home">Home</a>
    </li>
    <div class="container">
        <h1 class="page-title">Tasks List</h1>
        @if (session('user_assigned'))
        <div class="alert alert-success">
            {{session('user_assigned')}}
        </div>

        @endif
        @error('user_Id')
        {{$message}}
        @enderror
        @if ($errors->has('error'))
    <div class="alert alert-danger">
        {{ $errors->first('error') }}
    </div>
@endif
@foreach ($PfTasks as $task)


        <div class="projects-list">
            <!-- Example of a single project entry -->
            <div class="project-item">
                <h3 class="project-name">ID <span id="{{$task->id}}">{{$task->id}}</span> Task {{$task->name}}</h3>
                <p class="project-description"> {{$task->description}}</p>
                <div class="project-actions">

                <div id="inputFields{{$task->id}}"></div>
                <div id="button{{$task->id}}"></div>
                    <button class="edit-btn">Edit</button>
                    <form id ="delete-form" action="deletetask/{{$task->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button class="delete-btn"  onclick="confirmDelete({{$task->id}})">Delete</button>

                </form>
                <form action="AssignTeamMember/{{$task->id}}" id="assignform{{$task->id}}" method="GET">
                    @csrf
                    <button class="btn btn-primary" id="assignbutton{{$task->id}}" onclick="addFn({{$task->id}})">Assign to devoloper</button>
                    <input type="text" name="search_member_id" id="search_member_id">
                    <div id="search_list"></div>

            </form>
                </div>
                <script>
                    function confirmDelete(task) {
                        // Show a confirmation dialog before submitting the form
                        if (confirm('Are you sure you want to delete this task? This action cannot be undone.')) {
                            // If confirmed, submit the form
                            document.getElementById('delete-form'+task).submit();
                        }
                        else{event.preventDefault();}
                    }
                </script>
            </div>

            <!-- Example of another project entry -->


            <!-- Add more projects dynamically with foreach in Laravel -->
            @endforeach
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="searchuser.js"></script>

</body>
</html>



