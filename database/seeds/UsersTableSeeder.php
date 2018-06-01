<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Cauêh Queiroz',
            'email' => 'caueh@eqweb.com',
            'password' => bcrypt('321321')
        ]);

        User::create([
            'name' => 'Marcelo Wanderley',
            'email' => 'wanderley@eqweb.com',
            'password' => bcrypt('321321')
        ]);
    }
}
