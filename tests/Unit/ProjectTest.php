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
}
