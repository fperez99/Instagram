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
        $this->call(users::class);
        $this->call(images::class);
        $this->call(comment::class);
        $this->call(like::class);
    }
}
