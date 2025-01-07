@extends('PartialViews.admin.layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">User Management</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($user as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role ?? 'User' }}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $user->links() }} <!-- Pagination links -->
    </div>
</div>
@endsection
