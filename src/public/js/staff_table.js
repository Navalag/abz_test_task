$(document).ready(function() {

	var table = $('#example').DataTable({
		processing: true,
		serverSide: true,
		ajax: '/datatable/init',
		columns: [
			{ data: 'id' },
			{
				"data": "image_url",
				"render": function(data, type, row) {
					if (!data) {
						return '<img src="https://imgplaceholder.com/70x70/cccccc/757575/glyphicon-user/" />';
					}
					return '<img src="http://127.0.0.1:8000/'+data+'" />';
				}
			},
			{ data: 'fio' },
			{ data: 'position' },
			{ data: 'employment_date' },
			{ data: 'salary' },
			{ data: 'parent_id' },
		]
	});

	$('#example tbody').on('click', 'tr', function () {
		var data = table.row( this ).data();
		$('#name').val(data.fio);
		$('#position').val(data.position);
		$('#start_date').val(data.employment_date);
		$('#salary').val(data.salary);
		$('#manger_id').val(data.parent_id);
		$('#person_id').val(data.id);

		if ( $(this).hasClass('table-primary') ) {
			$(this).removeClass('table-primary');
			$('#edit').attr("disabled", true);
			$('#remove').attr("disabled", true);
			$('#add').attr("disabled", false);
		}
		else {
			table.$('tr.table-primary').removeClass('table-primary');
			$(this).addClass('table-primary');
			$('#edit').attr("disabled", false);
			$('#remove').attr("disabled", false);
			$('#add').attr("disabled", true);
		}
	});

	$('#deleteRow').click( function () {
		var person_info = table.row('.table-primary').data();
		var token =  $('input[name="_token"]');
		var data = {
			'person_id': person_info.id,
			'_token': token.attr('value')
		}
		$.post('/delete', data, function(response) {
			console.log(response);
			if (response.success) {
				$("#alertNotificationDelete").html('<div class="alert alert-info">'+response.success+'</div>');
				window.setTimeout(function () {
					$(".alert").fadeTo(500, 0).slideUp(500, function () {
						$(this).remove();
					});
					$('#modalDelete').modal('toggle');
				}, 2000);
				$('.table-primary').remove();
				$('#edit').attr("disabled", true);
				$('#remove').attr("disabled", true);
			}
			else {
				var msg = '';
				console.log(data.errors);
				$.each(data.errors[0], function(index, item) {
					msg += '<p class="mr-auto overflow-ellipsis no-padding" id="alerText">'+item+'</p>'
				});
				$("#alertNotificationDelete").html('<div class="alert alert-danger m-t-15">'+msg+'</div>');
			}
		});
	});

	$('#editRow').click( function(e) {
		e.preventDefault();
		$.post('/edit', $('#formEditRow').serialize(), function(data) {
				console.log(data);
				if (data.success) {
					$('tr.table-primary td:eq(1)').html(data.person_info.fio);
					$('tr.table-primary td:eq(2)').html(data.person_info.position);
					$('tr.table-primary td:eq(3)').html(data.person_info.employment_date);
					$('tr.table-primary td:eq(4)').html(data.person_info.salary);
					$('tr.table-primary td:eq(5)').html(data.person_info.parent_id);
					$("#alertNotification").html('<div class="alert alert-info">'+data.success+'</div>');
					window.setTimeout(function () {
						$(".alert").fadeTo(500, 0).slideUp(500, function () {
							$(this).remove();
						});
						$('#modalEdit').modal('toggle');
					}, 2000);
				}
				else {
					var msg = '';
					console.log(data.errors);
					$.each(data.errors[0], function(index, item) {
						msg += '<p class="mr-auto overflow-ellipsis no-padding" id="alerText">'+item+'</p>'
					});
					$("#alertNotification").html('<div class="alert alert-danger m-t-15">'+msg+'</div>');
				}
		});
	});

	$('#uploadAvatar').on('change', function(e) {
		var	img = e.target.files[0];
		var person_info = table.row('.table-primary').data();
		var token =  $('input[name="_token"]');
		var data = new FormData();
		data.append('image', img);
		data.append('person_id', person_info.id,);
		data.append("_token", token.attr('value'));
		$.ajax({
			url: '/upload_avatar',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success:function(response) {
				$('tr.table-primary td:eq(6) img').attr("src", 'http://127.0.0.1:8000/'+response.image);
				$("#alertNotification").html('<div class="alert alert-info d-flex m-t-15">Your avatar was updated.</div>');
				window.setTimeout(function () {
					$(".alert").fadeTo(500, 0).slideUp(500, function () {
						$(this).remove();
					});
				}, 2000);
			}
		});
	});

});
