<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    public function test_redirect_if_not_user_creating_post()
    {

        //  $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $this->post('/projects', $project->toArray())->assertRedirect('login');

        $this->get('/projects')->assertRedirect('login');

        $this->get('/projects/create')->assertRedirect('login');

        $this->get($project->path())->assertRedirect('login');
    }

    public function test_user_can_create_project()
    {

        // $this->withoutExceptionHandling();
        $this->actingAs(factory('App\User')->create());

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph

        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');



        $this->assertDatabaseHas('projects', $attributes);
    }

    public function test_user_can_view_project()
    {
        $this->actingAs(factory('App\User')->create());

        $project =  factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->get($project->path())->assertSee($project->title)->assertSee($project->description);
    }



    public function test_project_requires_title()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }



    public function test_project_requires_description()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }


    public function test_user_can_view_their_projects()
    {
        $this->actingAs(factory('App\User')->create());

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->get($project->path())->assertSee($project->title)->assertSee($project->description);
    }

    public function test_user_can_view_others_projects()
    {



        $this->actingAs(factory('App\User')->create());


        $project = factory('App\Project')->create();


        $this->get($project->path())->assertStatus(403);
    }
}
