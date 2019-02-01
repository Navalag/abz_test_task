<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class OrgChartController extends Controller
{
	public function index()
	{
		$employee = new Employee;
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
