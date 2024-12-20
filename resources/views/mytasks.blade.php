@include('PartialViews.head')
@include('PartialViews.navbar')


<h1>My tasks</h1>
@foreach ($PfTasks as $task)
{{ $task->Creator->name}}
{{ $task}}
{{ $task}}
{{ $task}}
{{ $task}}
@endforeach
