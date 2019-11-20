@extends('layouts.app')

@section('content')
<div class="container px-2">

    <header class="mb-3 py-3 flex">

        <div class="flex justify-between w-full items-center">
            <h2 class="text-gray-600"><a href="/projects"> My Project</a></h2>
            <div class="flex flex-row">
                @foreach ($project->members as $member)
                <img class="rounded-full mr-2" src="{{gravatar_url($member->email)}}" alt="{{$member->name}}">
                @endforeach

                <img class="rounded-full mr-2" src="{{gravatar_url($project->owner->email)}}">
                <a class="btn" href="{{$project->path().'/update'}}">Update Project</a>
            </div>
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

            <form action="{{$project->path()}}" method="POST">
                @CSRF
                @method('PATCH')
                <textarea class="card mt-2 w-full" name="notes" cols="30" rows="10">
                {{$project->notes}}
                </textarea>
                <button class="btn">Save</button>
            </form>
            @include('errors')




        </div>
        <div class="w-1/4">
            @include('projects.card')
            @include('projects.activity.card')
            @can('manage', $project)
            @include('projects.invite')
            @include('errors',['bag'=>'invitations'])
            @endcan
        </div>


    </div>

</div>
@endsection