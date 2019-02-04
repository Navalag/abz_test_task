<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Staff;

class OrgChartController extends Controller
{
	public function index()
	{
		$node = Staff::root();
		// $node = Staff::where('id', '=', 1)->first();
		// $node->descendants()->limitDepth(2)->get();
		$jsonEmployees = [];
		foreach($node->getDescendantsAndSelf(1) as $value) {
		// foreach($node->descendantsAndSelf()->limitDepth(2)->get() as $value) {
			$jsonEmployees[] = [
				'id' => $value->id,
				'name' => $value->fio,
				'title' => $value->position,
				'parent_id' => $value->parent_id,
				'relationship' => $this->getNodeRelationship($value)
			];
		}
		$tree = $this->buildTree($jsonEmployees);
		// dd($tree);

		return view('welcome')->with('employees', json_encode($tree));
	}

	public function orgChartGetJSON($relation, $nodeId)
	{
		$node = Staff::where('id', '=', $nodeId)->first();
		$jsonEmployees = [];

		foreach($node->getDescendantsAndSelf() as $value) {
			$jsonEmployees[] = [
				'id' => $value->id,
				'name' => $value->fio,
				'title' => $value->position,
				'parent_id' => $value->parent_id,
				'relationship' => $this->getNodeRelationship($value)
			];
		}
		$tree = $this->buildTree($jsonEmployees, $node->parent_id);
		$retVal = ['children' => $tree[0]['children']];
		// dd($retVal);

		return response()->json($retVal);
	}

	private function buildTree(array $elements, $parentId = 0)
	{
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

	private function getNodeRelationship($node)
	{
		$relationship = '';

		if ($node->isRoot()) {
			$relationship .= '00';
		} else {
			$relationship .= '11';
		}
		if ($node->isLeaf()) {
			$relationship .= '0';
		} else {
			$relationship .= '1';
		}

		return $relationship;
	}
}
