<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .task-form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .task-form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #007bff;
        }

        .form-group textarea {
            resize: none;
            height: 100px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
<script>
    var leaderId = localStorage.id;
    window.onload = function(){
   document.getElementById('leader_Id').value = leaderId;
   }
</script>
</head>
<body>
    <div class="task-form-container">
        <h2>Create a Team</h2>
        <form action="storeteam" method="POST">
            @csrf
            <div class="form-group">
                <label for="team-name">Team name</label>
                <input type="hidden" name="leader_Id" id="leader_Id">
                <input type="text" id="team-name" name="name" placeholder="Enter team name" required>
            </div>

            <button type="submit" class="submit-btn">Create a team</button>
        </form>
        @error('name')
        <div class="alert alert-danger">

            {{$message}}
        </div>
        @enderror
    </div>

</body>
</html>
