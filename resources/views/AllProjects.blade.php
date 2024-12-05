<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects List</title>
    <link rel="stylesheet" href="projectstyle.css">
</head>
<body>

    <div class="container">
        <h1 class="page-title">Projects List</h1>
@foreach ($Project as $p)


        <div class="projects-list">
            <!-- Example of a single project entry -->
            <div class="project-item">
                <h3 class="project-name">Project {{$p->name}}</h3>
                <p class="project-description"> {{$p->description}}</p>
                <div class="project-actions">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                </div>
            </div>

            <!-- Example of another project entry -->


            <!-- Add more projects dynamically with foreach in Laravel -->
            @endforeach
        </div>
    </div>

</body>
</html>
