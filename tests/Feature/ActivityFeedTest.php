<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use App\Task;

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
        $originalTitle = $project->title;
        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activity);

        tap($project->activity->last(), function ($activity) use ($originalTitle) {

            $this->assertEquals('updated', $activity->description);

            $expected = [
                'before' => ['title' => $originalTitle],
                'after' => ['title' => 'changed']
            ];
            $this->assertEquals($expected, $activity->changes);
        });
    }

    public function test_creating_task_records_activity()
    {

        $project = ProjectFactory::create();

        $project->addTask('new task');

        $this->assertCount(2, $project->activity);

        tap($project->activity->last(), function ($activity) {
            $this->assertEquals('created_task', $activity->description);
            $this->assertEquals('new task', $activity->subject->body);
            $this->assertInstanceOf(Task::class, $activity->subject);
            dd($activity->getAttributes());
            $this->assertNull($activity->changes);
        });
    }

    public function test_completing_task_records_activity()
    {

        $this->withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();


        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), ['body' => 'changed', 'completed' => true]);

        $this->assertCount(3, $project->activity);

        tap($project->activity->last(), function ($activity) {
            $this->assertEquals('completed_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
        });
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
