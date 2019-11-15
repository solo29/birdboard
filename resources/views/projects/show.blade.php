@extends('layouts.app')

@section('content')
<div class="container px-2">

    <header class="mb-3 py-3 flex">

        <div class="flex justify-between w-full items-center">
            <h2 class="text-gray-600">My Project</h2>
            <a class="btn" href="/projects/create">Create Project</a>
        </div>

    </header>

    <div class="lg:flex m-4 p-4">
        <div class="w-3/4 px-2">
            @foreach ($project->tasks as $tasks)
            <h2 class="card ">{{$tasks->body}}</h2>
            @endforeach


            <h2 class="card mt-5">General Notes</h2>

            <h2 class="card mt-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti pe
                rferendis reprehenderit ullam quae quibusdam, molestias porro ipsam maxi
                me voluptas reiciendis. Ut enim doloremque laboriosam cum veniam id blanditiis eligendi inv
                entore?</h2>
        </div>
        <div class="w-1/4">
            @include('projects.card')
        </div>


    </div>

</div>
@endsection