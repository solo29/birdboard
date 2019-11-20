<div class="card flex flex-col" style="height:200px">
    <h3 class="font-normal text-xl py-2  border-l-4 border-blue-300 -ml-5 pl-5">
        <a href="{{$project->path()}}"> {{$project->title}}</a>

    </h3>
    <p class="text-gray-600 mt-2 flex-1"> {{Str::limit($project->description, -1)}}</p>

    <footer class="mt-3">
        <form action="{{$project->path()}}" class="text-right" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="text-xs">Delete</button>
        </form>
    </footer>
</div>