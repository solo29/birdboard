<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;
use App\Project;

$factory->define(Task::class, function (Faker $faker) {
    return [
        //
        'body' => $faker->sentence,
        'completed' => false,
        'project_id' => factory(Project::class)
    ];
});
