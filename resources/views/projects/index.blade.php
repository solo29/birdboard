@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Birdboard</h1>
    <a href="/projects/create">Create Project</a>
    <ul>
        @forelse ($projects as $project)
        <li>
            <a href="{{$project->path()}}">{{$project->title}}</a>
        </li>
        @empty
        <li>No projects yet.</li>
        @endforelse
    </ul>
</div>
@endsection