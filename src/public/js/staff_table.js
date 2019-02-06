// $(document).ready(function() {
// 	$('#example').DataTable({
// 		data: data,
// 		columns: [
// 			{ data: 'id' },
// 			{ data: 'fio' },
// 			{ data: 'position' },
// 			{ data: 'employment_date' },
// 			{ data: 'salary' },
// 			{ data: 'manager_name' },
// 			{ data: 'parent_id' },
// 		]
// 	});
// });


$(document).ready(function() {
	$('#example').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{ url('create') }}',
		columns: [
			// { data: 'id' },
			{ data: 'fio' },
			{ data: 'position' },
			// { data: 'employment_date' },
			// { data: 'salary' },
			// { data: 'manager_name' },
			// { data: 'parent_id' },
		]
	});
});
