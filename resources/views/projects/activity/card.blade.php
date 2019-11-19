<div class="card mt-1">
    <ul>
        @foreach ($project->activity as $activity)
        <li>
            @include("projects.activity.{$activity->description}")
            <span class="text-gray-600">
                {{$activity->created_at->diffForHumans()}}
            </span>
        </li>
        @endforeach
    </ul>
</div>