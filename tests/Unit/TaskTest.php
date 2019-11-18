<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_has_path()
    {
        $task = factory('App\Task')->create();

        // $task->path();

        $this->assertEquals('/projects/' . $task->project->id . '/tasks/' . $task->id, $task->path());
    }


    public function test_it_belongs_to_project()
    {

        $task = factory('App\Task')->create();

        $this->assertInstanceOf('App\Project', $task->project);
    }

    public function test_it_can_be_completed()
    {

        $task = factory('App\Task')->create();

        $this->assertFalse($task->completed);

        $task->complete();

        $this->assertTrue($task->fresh()->completed);
    }

    public function test_it_can_be_incompleted()
    {

        $task = factory('App\Task')->create();


        $task->complete();

        $task->inComplete();
        $this->assertFalse($task->fresh()->completed);
    }
}
