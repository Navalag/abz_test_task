<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use \Carbon\Carbon;
use Datatables;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;

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
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function createDatatable()
	{
		return Datatables::of(Staff::query())->make(true);
	}

	public function createRow(Request $request)
	{
		$request->validate([
			'name'=> ['required', 'string', 'max:255'],
			'position'=> ['required', 'string', 'max:255'],
			'start_date' => ['required', 'string', 'max:255'],
			'salary' => ['required', 'string', 'min:1', 'max:11'],
			'manger_id' => ['numeric', 'nullable', 'min:1'],
		]);

		$node = Staff::create([
			'fio' => $request->get('name'),
			'position' => $request->get('position'),
			'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
			'salary' => $request->get('salary')
		]);
		$parent_node = Staff::where('id', '=', $request->get('manger_id'))->first();
		if ($parent_node) {
			$node->makeChildOf($parent_node);
		}
		$parent_node = Staff::where('id', '=', $request->get('manger_id'))->first();

		return back();
	}

	public function editRow(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id'=> ['required', 'numeric', 'min:1'],
			'name'=> ['required', 'string', 'max:255'],
			'position'=> ['required', 'string', 'max:255'],
			'start_date' => ['required', 'string', 'max:255'],
			'salary' => ['required', 'string', 'min:1', 'max:11'],
			'manger_id' => ['numeric', 'nullable', 'min:1'],
		]);

		if ($validator->fails()) {
			return response()->json([
				'errors' => [$validator->errors()->all()],
			]);
		}
		$employee = Staff::find($request->get('id'));
		$employee->fio = $request->get('name');
		$employee->position = $request->get('position');
		$employee->employment_date = $request->get('start_date');
		$employee->salary = $request->get('salary');
		$employee->save();
		if ($employee->isRoot()) {
			return response()->json([
				'success' => 'The row was successfully updated! Root node cannot be reassigned.',
				'person_info' => $employee
			]);
		}
		$employee->parent_id = $request->get('manger_id'); // set parent_id after save() to update value on front-end
		$parent_node = Staff::where('id', '=', $request->get('manger_id'))->first();
		$employee->makeChildOf($parent_node);

		return response()->json([
			'success' => 'The row was successfully updated!',
			'person_info' => $employee
		]);
	}

	public function deleteRow(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'person_id'=> ['required', 'numeric', 'min:1'],
		]);

		if ($validator->fails()) {
			return response()->json([
				'errors' => [$validator->errors()->all()],
			]);
		}
		$employee = Staff::find($request->get('person_id'));
		$employee->delete();

		return response()->json([
			'success' => 'The row was successfully deleted!',
			'person_info' => $employee
		]);
	}

	public function uploadPhoto(Request $request)
	{
		request()->validate([
			'person_id'=> ['required', 'numeric', 'min:1'],
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);
		$imageName = time().'.'.request()->image->getClientOriginalExtension();
		Image::make(request()->image)->fit(70)->save('avatar_img/'.$imageName);

		$employee = Staff::find($request->get('person_id'));
		if ($employee->image_url) {
			$src = $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.$employee->image_url;
			unlink($src);
		}
		$employee->image_url = 'avatar_img/'.$imageName;
		$employee->save();

		return response()->json([
			'success' => 'Your avatar was updated',
			'image' => $employee->image_url
		]);
	}
}
