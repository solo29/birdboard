<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_invite_to_project()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $invitedUser = factory(User::class)->create();

        $this->actingAs($project->owner)->post(
            $project->path() . '/invitations',

            ['email' => $invitedUser->email]
        )->assertRedirect($project->path());


        $this->assertTrue($project->members->contains($invitedUser));
    }

    public function test_invitation_only_for_registered()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', ['email' => 'notfound@not.ge'])

            ->assertSessionHasErrors(['email' => 'Invited user must have an account']);
    }


    public function test_invitation_wokrs()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $project->invite($newUser = factory(User::class)->create());

        $this->signIn($newUser);


        $this->post("/projects/{$project->id}/tasks", $task = ['body' => 'foo task']);

        //dd($project->fresh()->tasks->toArray());

        $this->assertDatabaseHas('tasks', $task);
    }

    public function test_only_owner_can_invite_member()
    {
        // $this->withoutExceptionHandling();


        $this->actingAs(factory(User::class)
            ->create())->post(ProjectFactory::create()->path() . '/invitations', ['email' => 'some@some.ge'])->assertStatus(403);
    }
}
