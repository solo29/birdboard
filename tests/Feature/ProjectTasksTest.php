<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_can_have_task()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'Test Task']);

        $this->get($project->path())->assertSee('Test Task');
    }

    public function test_task_can_be_updated()
    {

        $this->signIn();

        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $task = $project->addTask('old task');

        $this->patch($task->path(), ['body' => 'new task', 'completed' => true]);

        $this->assertDatabaseHas('tasks', ['body' => 'new task', 'completed' => true]);
    }

    public function test_requires_body()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $attributes = factory('App\Task')->raw(['body' => '']);


        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }

    public function test_owner_can_add_tasks_to_projects()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks', ['body' => 'cant add'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'cant add']);
    }

    public function test_owner_can_update_tasks_to_projects()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $task = $project->addTask('added');



        $this->patch($task->path(), ['body' => 'updated'])->assertStatus(403);


        $this->assertDatabaseMissing('tasks', ['body' => 'updated']);
    }
}
