@extends('layouts.app')

@section('content')
<div class="container card">
    Update

    <form action="{{$project->path().'/update'}}" method="POST">
        @CSRF
        @method('PATCH')
        <input class="w-full mt-2 border border-gray-600 rounded-lg px-2 py-2" type="text" name="title" value="{{$project->title}}">
        <textarea class="w-full mt-2 border border-gray-600 rounded-lg px-2 py-2" type="text" name="description">{{$project->description}}</textarea>
        <button class="btn">Submit</button>
    </form>
    <hr>

    <a href="{{$project->path()}}">Cancel</a>
</div>
@endsection