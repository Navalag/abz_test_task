$(function() {

	/*
	** handle lazy load links
	** for more details read docs: https://github.com/dabeng/OrgChart
	*/
	var ajaxURLs = {
		'children': function(nodeData) {
			return '/orgchart/children/' + nodeData.id;
		}
	};

	/*
	** init OrgChart plugin
	*/
	var oc = $('#chart-container').orgchart({
		'data': employees,
		'ajaxURL': ajaxURLs,
		'nodeContent': 'title',
		'nodeId': 'id',
		'draggable': true
	});

	/*
	** listen drag and drop events
	*/
	oc.$chart.on('nodedrop.orgchart', function(event, extraParams) {
		var draggedNodeId = extraParams.draggedNode.children()['0'].offsetParent.id;
		var dropZoneNodeId = extraParams.dropZone.children()['0'].offsetParent.id;
		var token =  $('meta[name="csrf-token"]').attr("content");
		var data = {
			'draggedNodeId': draggedNodeId,
			'dropZoneNodeId': dropZoneNodeId,
			'_token': token
		}
		$('.loader').css('opacity', '1');
		$('#chart-container').css('opacity', '0');
		$.post('/orgchart/drag_n_drop', data, function(response) {
			if (response.success) {
				$('.loader').css('opacity', '0');
				$('#chart-container').css('opacity', '1');
			}
			else {
				location.reload();
			}
		});
	});

});
