<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects List</title>
    <link rel="stylesheet" href="projectstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:forestgreen} </style>

</head>
<body>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="home">Home</a>
    </li>
    <div class="container">
        <h1 class="page-title">Work On List</h1>
        <table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr>
                    <th>Developer</th>
                    <th>Working on Task ID</th>
                    <th>Project</th>
                    <th>Task Name</th>
                    <th>Time Worked</th>
                </tr>
            </thead>
@foreach ($workon as $w)
<<tr>
    <td>{{ $w->user->name }}</td>
    <td>{{ $w->task_id }}</td>
    <td>{{ $w->task->project->title }}</td>
    <td>{{ $w->task->name }}</td>
    <td>{{ $w->created_at->diffForHumans()}}</td>
</tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>

</body>
</html>
