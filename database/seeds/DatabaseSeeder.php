<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
factory(App\User::class, 1)->create();
factory(App\Cities::class, 5)->create();
factory(App\Developers::class, 5)->create();
factory(App\Lists::class, 5)->create();
    }
}
