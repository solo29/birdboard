<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


        $userId = App\User::insertGetId([

            'name' => 'solo',
            'email' => 'solo@solo.ge',
            'password' => bcrypt('solo'),
        ]);

        $userId2 = App\User::insertGetId([

            'name' => 'shoka',
            'email' => 'shoka@shoka.ge',
            'password' => bcrypt('shoka'),
        ]);


        $quantity = 10;

        factory('App\Project', $quantity)->create(['owner_id' => $userId]);

        while ($quantity > 0) {
            factory('App\Task', rand(1, 8))->create(['project_id' => $quantity--]);
        }
    }
}
