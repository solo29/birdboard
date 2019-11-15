@extends('layouts.app')

@section('content')
<div class="container">

    <a href="/projects/create">Create Project</a>
    <div class="container mx-auto flex">
        @forelse ($projects as $project)
        <div class=" bg-white mr-2 rounded-lg shadow w-1/3 p-5" style="height:200px">
            <h3 class="font-normal text-xl py-2">
                {{$project->title}}
            </h3>
            <p class="text-gray-600"> {{Str::limit($project->description)}}</p>
        </div>
        @empty
        <div>No projects yet.</div>
        @endforelse
    </div>
</div>
@endsection