<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_can_have_task()
    {
        $user =  $this->signIn();

        $this->withoutExceptionHandling();

        $project = ProjectFactory::ownedBy($user)->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test Task']);

        $this->get($project->path())->assertSee('Test Task');
    }

    public function test_task_can_be_updated()
    {

        $user = $this->signIn();

        $this->withoutExceptionHandling();

        $project = ProjectFactory::ownedBy($user)->create();

        $task = $project->addTask('old task');

        $this->patch($task->path(), ['body' => 'new task', 'completed' => true]);

        $this->assertDatabaseHas('tasks', ['body' => 'new task', 'completed' => true]);
    }


    public function test_task_can_be_incompleted()
    {

        $user = $this->signIn();

        $this->withoutExceptionHandling();

        $project = ProjectFactory::ownedBy($user)->create();

        $task = $project->addTask('old task');
        $task->complete();

        $task->inComplete();

        $this->assertFalse($task->completed);
        // $this->patch($task->path(), ['body' => 'new task', 'completed' => true]);
        $this->assertDatabaseHas('tasks', ['completed' => false]);
    }


    public function test_task_can_be_completed_from_request()
    {

        $user = $this->signIn();

        $this->withoutExceptionHandling();

        $project = ProjectFactory::ownedBy($user)->create();

        $task = $project->addTask('old task');
        $task->complete();

        $this->patch($task->path(), ['body' => 'changed', 'completed' => false]);

        //$task->inComplete();

        // $this->patch($task->path(), ['body' => 'new task', 'completed' => true]);

        $this->assertDatabaseHas('tasks', ['completed' => false]);
    }

    public function test_requires_body()
    {
        $user = $this->signIn();

        $project = ProjectFactory::ownedBy($user)->create();

        $attributes = factory('App\Task')->raw(['body' => '']);


        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }

    public function test_owner_can_add_tasks_to_projects()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->post($project->path() . '/tasks', ['body' => 'cant add'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'cant add']);
    }

    public function test_owner_can_update_tasks_to_projects()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $task = $project->addTask('added');

        $this->patch($task->path(), ['body' => 'updated'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'updated']);
    }
}
