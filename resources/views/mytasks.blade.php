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
@foreach ($PfTasks as $task)


        <div class="projects-list">
            <!-- Example of a single project entry -->
            <div class="project-item">
                <h3 class="project-name">Task {{$task->name}}</h3>
                <p class="project-description"> {{$task->description}}</p>
                <div class="project-actions">
                    <button class="btn btn-primary" onclick="addFn({{$task->id}})">Assign to devoloper</button>
                <div id="inputFields{{$task->id}}"></div>
                    <button class="edit-btn">Edit</button>
                    <form id ="delete-form" action="deletetask/{{$task->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button class="delete-btn"  onclick="confirmDelete({{$task->id}})">Delete</button>

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
    <script>
        function addFn(id) {
            const divEle = document.getElementById("inputFields"+id);
            const wrapper = document.createElement("div");
            const iFeild = document.createElement("input");
            iFeild.setAttribute("type", "text");
            iFeild.setAttribute("placeholder", "Enter value");
            iFeild.classList.add("input-field");
            wrapper.appendChild(iFeild);
            divEle.appendChild(wrapper);

        }
    </script>
</body>
</html>



