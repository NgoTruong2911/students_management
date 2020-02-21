<?php

use Illuminate\Database\Seeder;

class UserSubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User_subject::class, 10)->create();
    }
}
