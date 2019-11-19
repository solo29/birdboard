<div class="card mt-1">
    <ul>
        @foreach ($project->activity as $activity)
        <li>
            @include("projects.activity.{$activity->description}")
            {{$activity->created_at->diffForHumans()}}
        </li>
        @endforeach
    </ul>
</div>