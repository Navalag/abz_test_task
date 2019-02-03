<?php

use Illuminate\Database\Seeder;
use \App\Staff;

class StaffTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		$staff = [[
			'fio' => 'Lao Lao',
			'position' => 'general manager',
			'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
			'salary' => 5000,
			'children' => []
		]];
		for ($j=0; $j < 10; $j++) { 
			array_push($staff[0]['children'], [
				'fio' => 'Lao',
				'position' => 'general',
				'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
				'salary' => 5000,
				'children' => []
			]);
			for ($i=0; $i < 10; $i++) { 
				array_push($staff[0]['children'][$j]['children'], [
					'fio' => 'Lao Lao',
					'position' => 'general manager',
					'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
					'salary' => 5000,
					'children' => []
				]);
				for ($a=0; $a < 10; $a++) { 
					array_push($staff[0]['children'][$j]['children'][$i]['children'], [
						'fio' => 'Lao Lao',
						'position' => 'general manager',
						'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
						'salary' => 5000,
						'children' => []
					]);
					for ($b=0; $b < 10; $b++) { 
						array_push($staff[0]['children'][$j]['children'][$i]['children'][$a]['children'], [
							'fio' => 'Lao Lao',
							'position' => 'general manager',
							'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
							'salary' => 5000,
							'children' => []
						]);
						for ($c=0; $c < 5; $c++) { 
							array_push($staff[0]['children'][$j]['children'][$i]['children'][$a]['children'][$b]['children'], [
								'fio' => 'Lao Lao',
								'position' => 'general manager',
								'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
								'salary' => 5000
							]);
						}
					}
				}
			}
		}
		// dd($staff);
		// $root = Staff::create($staff);
		Staff::buildTree($staff); // => true
	}
}
