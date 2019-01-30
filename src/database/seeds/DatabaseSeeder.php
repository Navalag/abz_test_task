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
		DB::table('employees')->insert([
			'fio' => "Steve Jobs",
	        'position' => "CEO",
	        'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
	        'salary' => 5000,
	        'boss_id' => 0,
		]);

		$empoyees = factory(App\Employee::class, 1000)->create();
	}
}
