@extends('layouts.app')

@section('content')
<div class="container">
    Create

    <form action="/projects" method="POST">
        @CSRF
        <input type="text" name="title">
        <textarea type="text" name="description"></textarea>
        <button>Submit</button>
    </form>

    <a href="/projects">Projects</a>
</div>
@endsection