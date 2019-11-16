@extends('layouts.app')

@section('content')
<div class="container px-2">

    <header class="mb-3 py-3 flex">

        <div class="flex justify-between w-full items-center">
            <h2 class="text-gray-600"><a href="/projects"> My Project</a></h2>
            <a class="btn" href="/projects/create">Create Project</a>
        </div>

    </header>

    <div class="lg:flex m-4 p-4">
        <div class="w-3/4 px-2">
            Tasks

            @forelse ($project->tasks as $task)

            <div class="card mt-2">

                <form action="{{$task->path()}}" method="POST">
                    @CSRF
                    @method('PATCH')
                    <div class="flex">
                        <input name="body" class="w-full" value="{{$task->body}}" placeholder="There is No Task Bae :)">
                        <input {{ $task->completed ? 'checked':''}} type="checkbox" name="completed" onchange="this.form.submit()">
                    </div>
                </form>
            </div>

            @empty
            <div class="card">
                <p>There is No Tasks</p>
            </div>
            @endforelse

            <div class="card mt-2">
                <form action="{{$project->path()}}/tasks" method="POST">
                    @CSRF
                    <input name="body" class="w-full" placeholder="There is No Task Bae :)">
                </form>
            </div>





        </div>
        <div class="w-1/4">
            @include('projects.card')
        </div>


    </div>

</div>
@endsection