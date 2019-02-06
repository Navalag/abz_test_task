<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$staff = Staff::all();
		$jsonStaffTable = [];

		foreach ($staff as $value) {
			$jsonStaffTable[] = [
				'id' => $value->id,
				'fio' => $value->fio,
				'position' => $value->position,
				'salary' => $value->salary
			];
		}

		return view('home')->with('data', json_encode($jsonStaffTable));
	}
}
