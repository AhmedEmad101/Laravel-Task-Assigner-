@include('PartialViews.head')
@include('PartialViews.adminsidebar')
@include('PartialViews.maincontent')
<div class="content">
    @foreach ($user as $u)


    <div class="card">
        <h3>{{$u->name}}</h3>
        <h3>{{$u->UserProjects}}</h3>

    </div>
    @endforeach
