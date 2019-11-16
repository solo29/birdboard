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
}
