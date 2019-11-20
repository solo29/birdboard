<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationRequest;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    //

    public function store(Project $project, ProjectInvitationRequest $request)
    {

        // $this->authorize('update', $project);

        // request()->validate(
        //     ['email' => ['required', 'exists:users,email']],
        //     ['email.exists' => 'Invited user must have an account']
        // );


        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }
}
