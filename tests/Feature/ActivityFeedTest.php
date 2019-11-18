<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_project_records_activity()
    {

        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);

        $this->assertEquals('created', $project->activity[0]->description);
    }

    public function test_updating_projects_records_new_activity()
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activity);

        $this->assertEquals('updated', $project->activity->last()->description);
    }

    public function test_creating_task_records_activity()
    {

        $project = ProjectFactory::create();

        $project->addTask('new task');

        $this->assertCount(2, $project->activity);

        $this->assertEquals('created_task', $project->activity->last()->description);
    }

    public function test_completing_task_records_activity()
    {

        $this->withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();


        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), ['body' => 'changed', 'completed' => true]);

        $this->assertCount(3, $project->activity);

        $this->assertEquals('completed_task', $project->activity->last()->description);
    }

    public function test_deleting_task_records_activity()
    {

        $this->withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();

        $this->assertCount(2, $project->activity);

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->fresh()->activity);
    }
}
