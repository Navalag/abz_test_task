$(function() {

	var ajaxURLs = {
		'children': function(nodeData) {
			return '/orgchart/children/' + nodeData.id;
		}
	};

	// console.log(employees);

	var oc = $('#chart-container').orgchart({
		'data': employees,
		'ajaxURL': ajaxURLs,
		'nodeContent': 'title',
		'nodeId': 'id',
		// 'draggable': true,
		// 'dropCriteria': function($draggedNode, $dragZone, $dropZone) {
		// 	if($draggedNode.find('.content').text().indexOf('manager') > -1 && $dropZone.find('.content').text().indexOf('engineer') > -1) {
		// 		return false;
		// 	}
		// 	return true;
		// }
	});

	// oc.$chart.on('nodedrop.orgchart', function(event, extraParams) {
	// 	console.log('draggedNode:' + extraParams.draggedNode.children('.title').text()
	// 		+ ', dragZone:' + extraParams.dragZone.children('.title').text()
	// 		+ ', dropZone:' + extraParams.dropZone.children('.title').text()
	// 	);
	// });

});
