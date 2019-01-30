<?php

use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();

    	for($i = 0; $i < 1000; $i++) {
	        App\Employee::create([
	            'fio' => $faker->name,
                'position' => $faker->jobTitle,
                'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
                'salary' => random_int(1000, 5000),
                'boss_id' => random_int(0, 9),
	        ]);
	    }
    }
}
