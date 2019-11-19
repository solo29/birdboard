@extends('layouts.app')

@section('content')
<div class="container">
    <header class="mb-3 py-3 flex">

        <div class="flex justify-between w-full items-center">
            <h2 class="text-gray-600">My Project</h2>
            <a class="btn" href="/projects/create">Create Project</a>
        </div>

    </header>

    <div class="container mx-auto lg:flex lg:flex-wrap">
        @forelse ($projects as $project)
        <div class="lg:w-1/3 px-3 py-3">
            @include('projects.card')

        </div>
        @empty
        <div>No projects yet.</div>
        @endforelse
    </div>


</div>
@endsection