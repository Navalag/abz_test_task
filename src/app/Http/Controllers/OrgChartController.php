<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Validator;

class OrgChartController extends Controller
{
	public function index()
	{
		$node = Staff::root();
		$jsonEmployees = [];

		if ($node) {
			foreach($node->descendantsAndSelf()->limitDepth(2)->get() as $value) {
				$jsonEmployees[] = [
					'id' => $value->id,
					'name' => $value->fio,
					'title' => $value->position,
					'parent_id' => $value->parent_id,
					'relationship' => $this->getNodeRelationship($value)
				];
			}
		}
		$tree = $this->buildTree($jsonEmployees);

		return view('welcome')->with('employees', json_encode($tree));
	}

	public function orgChartGetJSON($relation, $nodeId)
	{
		$node = Staff::where('id', '=', $nodeId)->first();
		$jsonEmployees = [];

		foreach($node->descendantsAndSelf()->limitDepth(1)->get() as $value) {
			$jsonEmployees[] = [
				'id' => $value->id,
				'name' => $value->fio,
				'title' => $value->position,
				'parent_id' => $value->parent_id,
				'relationship' => $this->getNodeRelationship($value)
			];
		}
		$tree = $this->buildTree($jsonEmployees, $node->parent_id);

		return response()->json(['children' => $tree[0]['children']]);
	}

	public function dragAndDrop(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'draggedNodeId'=> ['required', 'numeric', 'min:1'],
			'dropZoneNodeId'=> ['required', 'numeric', 'min:1'],
		]);
		if ($validator->fails()) {
			return response()->json([
				'errors' => [$validator->errors()->all()],
			]);
		}

		$node = Staff::where('id', '=', $request->get('draggedNodeId'))->first();
		$parent_node = Staff::where('id', '=', $request->get('dropZoneNodeId'))->first();
		$node->makeChildOf($parent_node);

		return response()->json([
			'success' => ':)'
		]);
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
