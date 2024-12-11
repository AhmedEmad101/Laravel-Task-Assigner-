<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="Auth.js"></script>
    <script src="AuthData.js"></script>
    <script src="LoginCheck.js"></script>
    <script src="{{asset('logout.js') }}"></script>
    <script src="{{asset('testlogout.js') }}"></script>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin</h2>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="adminallusers">Users</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="login">Logout</a></li>

            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header>
                <div class="header-info">
                    <h1>Admin Dashboard</h1>
                    <div class="user-info">
                        <span>Welcome, Admin</span>
                        <img src="https://via.placeholder.com/40" alt="User Image">
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="content">
                <div class="card">
                    <h3>Total Users</h3>
                    <p>{{$user->count()}}</p>
                </div>
                <div class="card">
                    <h3>Total Projects</h3>
                    <p>{{$Project->count()}}</p>
                </div>
                <div class="card">
                    <h3>Active Tasks</h3>
                    <p>{{$task->count()}}</p>
                </div>
                <div class="card">
                    <h3>Teams</h3>
                    <p>{{$team->count()}}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
