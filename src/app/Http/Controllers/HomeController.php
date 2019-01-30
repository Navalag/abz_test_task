<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

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
        $employee = new Employee;
        $employeesLevelOne = $employee::where('boss_id', 0)->get();
        $employeesLevelTwo = $employee::where('boss_id', 1)->get();
        $employeesLevelThree = $employee::where('boss_id', 2)->get();

        $jsonLevelOne = [];
        // $jsonLevelOneValue = [];
        foreach ($employeesLevelTwo as $value) {
            $jsonLevelOne[] = [
                'name' => $value->fio,
                'position' => $value->position,
            ];

            // $jsonLevelOneValue['name'] = $value->fio;
            // $jsonLevelOneValue['position'] = $value->position;
            // $jsonLevelOne[] = $jsonLevelOneValue;
        }
        dd(json_encode($jsonLevelOne));

        $jsonLevelTwo = [];
        $jsonLevelTwoValue = [];
        foreach ($employeesLevelTwo as $value) {
            $jsonLevelTwoValue['name'] = $value->fio;
            $jsonLevelTwoValue['position'] = $value->position;
            $jsonLevelTwo[] = $jsonLevelTwoValue;
        }

        $jsonLevelThree = [];
        $jsonLevelThreeValue = [];
        foreach ($employeesLevelThree as $value) {
            $jsonLevelThreeValue['name'] = $value->fio;
            $jsonLevelThreeValue['position'] = $value->position;
            $jsonLevelThree[] = $jsonLevelThreeValue;
        }

        return view('home')->with('levelOne', json_encode($jsonLevelOne))
                           ->with('levelTwo', json_encode($jsonLevelTwo))
                           ->with('levelThree', json_encode($jsonLevelThree));
    }
}
