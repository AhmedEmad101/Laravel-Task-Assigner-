<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Auth.js"></script>
    <script src="AuthData.js"></script>
    <script src="LoginCheck.js"></script>
    <script src="{{asset('logout.js') }}"></script>
    <script src="{{asset('testlogout.js') }}"></script>
    <script> window.onload = function() {
        document.getElementById("id").value = userId;
      };  </script>
    <title>Project Form</title>
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
</head>
<body>
    <div class="task-form-container">
        <h2>Contact Us</h2>
        <form action="createproject" method="post">
            @csrf
            <input type="hidden" id="id" name="UserId" >
            <div class="form-group">
                <label for="task-name">Email</label>
                <input type="text" id="task-name" name="title" placeholder="Enter project name" required>
            </div>
            <div class="form-group">
                <label for="task-description">Your Problem</label>
                <textarea id="task-description" name="description" placeholder="Enter your problem details" required></textarea>
            </div>
            <button type="submit" class="submit-btn" >Submit</button>
        </form>
     @error('title')
        {{$message}}
     @enderror
     @error('description')
     {{$message}}
     @enderror
    </div>
</body>

</html>