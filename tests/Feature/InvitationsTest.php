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


    public function test_project_can_invate_user()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $project->invite($newUser = factory(User::class)->create());

        $this->signIn($newUser);


        $this->post("/projects/{$project->id}/tasks", $task = ['body' => 'foo task']);

        //dd($project->fresh()->tasks->toArray());

        $this->assertDatabaseHas('tasks', $task);
    }
}
