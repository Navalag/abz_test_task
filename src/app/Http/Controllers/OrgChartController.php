<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class OrgChartController extends Controller
{
	private function buildTree(array $elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['boss_id'] == $parentId) {
				$children = $this->buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}

		return $branch;
	}

	public function index()
	{
		$employee = new Employee;

		// $employees = Employee::where(['boss_id' => 0,'boss_id' => 1,'boss_id' => 2])->get();
		$employees = 	$employee::where('boss_id', 0)
								->orWhere('boss_id', 1)
								->orWhere('boss_id', 2)
								->get();
		
		$jsonEmployees = [];
		foreach ($employees as $value) {
			$jsonEmployees[] = [
				'id' => $value->id,
				'name' => $value->fio,
				'title' => $value->position,
				'boss_id' => $value->boss_id,
			];
		}
		
		$tree = $this->buildTree($jsonEmployees);
		// dd($tree);

		return view('welcome')->with('employees', json_encode($tree));

		
		$employeesLevelOne = $employee::where('boss_id', 0)->get();
		$employeesLevelTwo = $employee::where('boss_id', 1)->get();
		$employeesLevelThree = $employee::where('boss_id', 2)->get();

		$jsonLevelOne = [];
		foreach ($employeesLevelOne as $value) {
			$jsonLevelOne[] = [
				'id' => $value->id,
				'name' => $value->fio,
				'title' => $value->position,
			];
		}

		$jsonLevelTwo = [];
		foreach ($employeesLevelTwo as $value) {
			$jsonLevelTwo[] = [
				'id' => $value->id,
				'name' => $value->fio,
				'title' => $value->position,
			];
		}

		$jsonLevelThree = [];
		foreach ($employeesLevelThree as $value) {
			$jsonLevelThree[] = [
				'id' => $value->id,
				'name' => $value->fio,
				'title' => $value->position,
			];
		}
		// print_r(json_encode($jsonLevelOne));die();

		return view('welcome')->with('levelOne', json_encode($jsonLevelOne))
							  ->with('levelTwo', json_encode($jsonLevelTwo))
							  ->with('levelThree', json_encode($jsonLevelThree));
	}
}
