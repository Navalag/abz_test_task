<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class OrgChartController extends Controller
{
    public function index()
    {
        return view('home')->with('user_info', \Auth::user())->with('lang', \Session::get('locale')=='ua' ? 'Українська' : 'English');
    }
}
