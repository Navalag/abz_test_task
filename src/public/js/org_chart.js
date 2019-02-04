$(function() {

	// $.mockjax({
	// 	url: '/orgchart/children/n3',
	// 	contentType: 'application/json',
	// 	responseTime: 1000,
	// 	responseText: { 'children': [
	// 		{ 'id': 'n4', 'name': 'Pang Pang', 'title': 'engineer', 'relationship': '110' },
	// 		{ 'id': 'n5', 'name': 'Xiang Xiang', 'title': 'UE engineer', 'relationship': '110'}
	// 	]}
	// });

	// $.mockjax({
	// 	url: '/orgchart/children/2',
	// 	contentType: 'application/json',
	// 	responseTime: 1000,
	// 	responseText: { 'children': [
	// 		{ 'id': 'n14', 'name': 'Pangs Pang', 'title': 'engineer', 'relationship': '110' },
	// 		{ 'id': 'n15', 'name': 'Xiangs Xiang', 'title': 'UE engineer', 'relationship': '110'}
	// 	]}
	// });

	// $.mockjax({
	// 	url: '/orgchart/parent/n1',
	// 	contentType: 'application/json',
	// 	responseTime: 1000,
	// 	responseText: { 'id': 'n6','name': 'Lao Lao', 'title': 'general manager', 'relationship': '001' }
	// });

	// $.mockjax({
	// 	url: '/orgchart/siblings/n1',
	// 	contentType: 'application/json',
	// 	responseTime: 1000,
	// 	responseText: { 'siblings': [
	// 		{ 'id': '7','name': 'Bo Miao', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': '8', 'name': 'Yu Jie', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': '9', 'name': 'Yu Li', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': '10', 'name': 'Hong Miao', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': '11', 'name': 'Yu Wei', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': '12', 'name': 'Chun Miao', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': '13', 'name': 'Yu Tie', 'title': 'department engineer', 'relationship': '110' }
	// 	]}
	// });

	// $.mockjax({
	// 	url: '/orgchart/families/n1',
	// 	contentType: 'application/json',
	// 	responseTime: 1000,
	// 	responseText: {
	// 		'id': 'n6',
	// 		'name': 'Lao Lao',
	// 		'title': 'general manager',
	// 		'relationship': '001',
	// 		'children': [
	// 		{ 'id': 'n7','name': 'Bo Miao', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': 'n8', 'name': 'Yu Jie', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': 'n9', 'name': 'Yu Li', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': 'n10', 'name': 'Hong Miao', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': 'n11', 'name': 'Yu Wei', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': 'n12', 'name': 'Chun Miao', 'title': 'department engineer', 'relationship': '110' },
	// 		{ 'id': 'n13', 'name': 'Yu Tie', 'title': 'department engineer', 'relationship': '110' }
	// 	]}
	// });

	// var datascource = {
	// 	'id': 'n1',
	// 	'name': 'Su Miao',
	// 	'title': 'department manager',
	// 	'relationship': '111',
	// 	'children': [
	// 		{ 'id': 'n2','name': 'Tie Hua', 'title': 'senior engineer', 'relationship': '111' },
	// 		{ 'id': 'n3','name': 'Hei Hei', 'title': 'senior engineer', 'relationship': '111' }
	// 	]
	// };

	var ajaxURLs = {
		'children': function(nodeData) {
			return '/orgchart/children/' + nodeData.id;
		}
		// 'parent': '/orgchart/parent/',
		// 'siblings': function(nodeData) {
		// 	return '/orgchart/siblings/' + nodeData.id;
		// },
		// 'families': function(nodeData) {
		// 	return '/orgchart/families/' + nodeData.id;
		// }
	};

console.log(employees);

	$('#chart-container').orgchart({
		'data': employees,
		'ajaxURL': ajaxURLs,
		'nodeContent': 'title',
		'nodeId': 'id'
	});

});
