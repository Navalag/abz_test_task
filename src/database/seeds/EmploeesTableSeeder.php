<?php

use Illuminate\Database\Seeder;
use \App\Employee;
// use Faker\Generator as Faker;

class EmploeesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		$rootNode = [
			'fio' => 'Lao Lao',
			'position' => 'general manager',
			'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
			'salary' => 5000
		];

		$root = new Employee($rootNode);
		$root->save(); // Saved as root

		for ($i=0; $i < 10; $i++) { 
			$attributes = [
				'fio' => $faker->name,
				'position' => $faker->jobTitle,
				'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
				'salary' => random_int(1000, 5000)
			];
			$nodeLevelTwo = new Employee($attributes);
			$root->appendNode($nodeLevelTwo);
			for ($j=0; $j < 10; $j++) { 
				$attributes = [
					'fio' => $faker->name,
					'position' => $faker->jobTitle,
					'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
					'salary' => random_int(1000, 5000)
				];
				$nodeLevelThree = new Employee($attributes);
				$nodeLevelTwo->appendNode($nodeLevelThree);
				for ($a=0; $a < 10; $a++) { 
					$attributes = [
						'fio' => $faker->name,
						'position' => $faker->jobTitle,
						'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
						'salary' => random_int(1000, 5000)
					];
					$nodeLevelFour = new Employee($attributes);
					$nodeLevelThree->appendNode($nodeLevelFour);
					for ($b=0; $b < 10; $b++) { 
						$attributes = [
							'fio' => $faker->name,
							'position' => $faker->jobTitle,
							'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
							'salary' => random_int(1000, 5000)
						];
						$nodeLevelFive = new Employee($attributes);
						$nodeLevelFour->appendNode($nodeLevelFive);
						for ($c=0; $c < 5; $c++) { 
							$attributes = [
								'fio' => $faker->name,
								'position' => $faker->jobTitle,
								'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
								'salary' => random_int(1000, 5000)
							];
							$nodeLevelSix = new Employee($attributes);
							$nodeLevelFive->appendNode($nodeLevelSix);
						}
					}
				}
			}
		}
		
	}
}
