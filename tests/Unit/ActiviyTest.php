<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ActiviyTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_user()
    {
        $user = $this->signIn();
        $project = ProjectFactory::ownedBy($user)->create();



        $this->assertEquals($user->id, $project->activity->first()->user->id);
    }
}
