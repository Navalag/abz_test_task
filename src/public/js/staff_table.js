$(document).ready(function() {
	$('#example').DataTable({
		data: data,
		columns: [
			{ data: 'id' },
			{ data: 'fio' },
			{ data: 'position' },
			{ data: 'salary' }
		]
	});
});
