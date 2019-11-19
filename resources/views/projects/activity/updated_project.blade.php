@if (count($activity->changes['after'])==1)
{{$activity->user->name}} updated the {{key($activity->changes['after'])}}
@else

you Updated Project

@endif