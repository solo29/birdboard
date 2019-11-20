<div class="card">
    <form action="{{$project->path()}}/invitations" method="POST">
        @CSRF
        <input placeholder="Email" class="rounded-lg border border-gray-500 mt-2 w-full" name="email" />

        <button class="btn mt-2">Invite</button>
    </form>
</div>