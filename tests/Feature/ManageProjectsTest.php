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
        $this->signIn();

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
        $this->signIn();

        $project =  factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->get($project->path())->assertSee($project->title)->assertSee($project->description);
    }



    public function test_project_requires_title()
    {
        $this->signIn();

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }



    public function test_project_requires_description()
    {
        $this->signIn();

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }


    public function test_user_can_view_their_projects()
    {
        $this->signIn();

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->get($project->path())->assertSee($project->title)->assertSee($project->description);
    }

    public function test_user_can_view_others_projects()
    {



        $this->signIn();


        $project = factory('App\Project')->create();


        $this->get($project->path())->assertStatus(403);
    }
}
