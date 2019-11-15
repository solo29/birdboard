@extends('layouts.app')

@section('content')
<div class="container">

    <h1>
        {{$project->title}}
    </h1>
    <p>
        {{$project->description}}
    </p>

    <a href="/projects">Back</a>
</div>
@endsection