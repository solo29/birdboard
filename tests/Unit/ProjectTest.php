<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;


    public function test_it_has_path()
    {
        $project = factory('App\Project')->create();

        $this->assertEquals($project->path(), '/projects/' . $project->id);
    }


    public function test_it_has_add_task()
    {
        $project = factory('App\Project')->create();

        $task = $project->addTask('Test Task');

        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }
}
