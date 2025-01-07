<div class="container">
    <h1 class="mt-4">Users Contacts</h1>
    <style>
        /* Container Styling */
        .container {
            font-family: Arial, sans-serif;
            margin-top: 20px;
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Email</th>
                <th scope="col">Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Contacts as $user)
                <tr>
                    <td>{{ $user->user_Id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->message }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
