<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Staff;

class OrgChartController extends Controller
{
	private function buildTree(array $elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['parent_id'] == $parentId) {
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
		$node = Staff::where('id', '=', 1)->first();
		// $node->descendants()->limitDepth(2)->get();
		$jsonEmployees = [];
		foreach($node->getDescendantsAndSelf() as $value) {
			$jsonEmployees[] = [
				'id' => $value->id,
				'name' => $value->fio,
				'title' => $value->position,
				'parent_id' => $value->parent_id,
			];
		}
		$tree = $this->buildTree($jsonEmployees);
		// dd($tree);

		return view('welcome')->with('employees', json_encode($tree));
	}
}
