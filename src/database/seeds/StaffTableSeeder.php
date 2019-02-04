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
		$staff = [];
		array_push($staff, $this->getDummyInfo());
		for ($j=0; $j < 5; $j++) { 
			array_push($staff[0]['children'], $this->getDummyInfo());
			for ($i=0; $i < 5; $i++) { 
				array_push($staff[0]['children'][$j]['children'], $this->getDummyInfo());
				for ($a=0; $a < 5; $a++) { 
					array_push($staff[0]['children'][$j]['children'][$i]['children'], $this->getDummyInfo());
					for ($b=0; $b < 5; $b++) { 
						array_push($staff[0]['children'][$j]['children'][$i]['children'][$a]['children'], $this->getDummyInfo());
						for ($c=0; $c < 8; $c++) { 
							array_push($staff[0]['children'][$j]['children'][$i]['children'][$a]['children'][$b]['children'], $this->getDummyInfo());
							for ($d=0; $d < 10; $d++) { 
								array_push($staff[0]['children'][$j]['children'][$i]['children'][$a]['children'][$b]['children'][$c]['children'], $this->getDummyInfo());
							}
						}
					}
				}
			}
		}

		Staff::buildTree($staff); // => true
	}

	private function getDummyInfo()
	{
		$faker = Faker\Factory::create();

		return [
			'fio' => $faker->name,
			'position' => $faker->jobTitle,
			'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
			'salary' => random_int(1000, 5000),
			'children' => []
		];
	}
}
