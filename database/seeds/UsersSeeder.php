<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create()->each(function($u){
            $u->capital()->create([
                'money' => 1000000.00,
            ]);
        });
    }
}
