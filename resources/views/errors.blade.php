@if ($errors->{$bag ?? 'default'}->any())
<div class="card ">
    <ul>
        @foreach ($errors->{$bag ?? 'default'}->all() as $error)
        <li class="text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif