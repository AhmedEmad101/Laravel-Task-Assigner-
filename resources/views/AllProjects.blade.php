<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects List</title>
    <link rel="stylesheet" href="projectstyle.css">


</head>
<body>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="home">Home</a>
    </li>
    <div class="container">
        <h1 class="page-title">Projects List</h1>
@foreach ($PfProjects as $p)


        <div class="projects-list">
            <!-- Example of a single project entry -->
            <div class="project-item">
                <h3 class="project-name">{{$p->title}}</h3>
                <p class="project-description"> {{$p->description}}</p>
                <div class="project-actions">

                    <button class="edit-btn">Edit</button>
                    <form id ="delete-form" action="delete/{{$p->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button class="delete-btn"  onclick="confirmDelete({{ $p->id }})">Delete</button>
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
