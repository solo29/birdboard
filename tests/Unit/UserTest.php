<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    public function test_user_has_many_projects()
    {

        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    public function test_project_belongsto_user()
    {
        $project = factory('App\Project')->create();

        $this->assertInstanceOf('App\User', $project->owner);
    }

    public function test_has_all_project()
    {
        $solo = $this->signIn();

        ProjectFactory::ownedBy($solo)->create();

        $this->assertCount(1, $solo->allProjects());

        $eka = factory(User::class)->create();

        ProjectFactory::ownedBy($eka)->create()->invite($solo);

        $this->assertCount(1, $eka->allProjects());

        $this->assertCount(2, $solo->allProjects());
        //$this->assertInstanceOf('App\User', $project->allProjects);
    }
}
