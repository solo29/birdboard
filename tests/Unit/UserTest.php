<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    public function test_user_has_many_projects()
    {

        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
