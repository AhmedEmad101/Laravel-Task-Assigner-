<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Plans</title>
    <link rel="stylesheet" href="Subscription.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional Bootstrap Icons (for using icons in navbar) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="Auth.js"></script>
    <script src="AuthData.js"></script>
    <script src="LoginCheck.js"></script>
    <script src="{{asset('logout.js') }}"></script>
    <script src="{{asset('testlogout.js') }}"></script>
    <script> window.onload = function() {
        document.getElementById("id").value = userId;
      };  </script>
</head>
<body>

    <div class="subscription-container">

        @foreach ($tier as $t)
        <div class="subscription {{$t->name}}">
            <h2>{{$t->name}}</h2>
            <p>Basic plan for getting started.</p>
            <form action="Pay/{{$t->id}}" method="post">
                @csrf
            <input type="hidden" id="tierid" value="{{$t->id}}" name="tier">
            <input type="hidden" id="id" name="UserId" >
            <button class="btn btn-primary" >Buy for {{$t->price}} $</button>
        </form>
        </div>
        @endforeach
    </div>
</body>
<script> console.log(userId);</script>
</html>
