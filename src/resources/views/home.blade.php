@extends('layouts.app')

@section('content')
<div class="container">
	<button type="button" id="add" class="btn btn-outline-success btn-sm mb-3">Add</button>
	<button type="button" id="edit" class="btn btn-outline-secondary btn-sm mb-3" data-toggle="modal" data-target="#exampleModalCenter" disabled>Edit</button>
	<button type="button" id="remove" class="btn btn-outline-danger btn-sm mb-3">Delete</button>
	<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
		<thead>
			<tr>
				<th style="width: 15px;">ID</th>
				<th style="width: 150px;">Name</th>
				<th>Position</th>
				<th style="width: 100px;">Start Date</th>
				<th style="width: 100px;">Salary</th>
				<th style="width: 15px;">Manager Id</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Position</th>
				<th>Start Date</th>
				<th>Salary</th>
				<th>Manager Id</th>
			</tr>
		</tfoot>
	</table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit selected row</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="position">Position</label>
            <input type="text" class="form-control" id="position" placeholder="Position">
          </div>
          <div class="form-group">
            <label for="sart_date">Start Date</label>
            <input type="text" class="form-control" id="sart_date">
          </div>
          <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" step="1" class="form-control" id="salary" placeholder="Salary">
          </div>
          <div class="form-group">
            <label for="manger_id">Manager Id</label>
            <input type="number" step="1" class="form-control" id="manger_id" placeholder="Manager Id">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/datatables.min.js"></script>

	<script>
		$(document).ready(function() {

			var table = $('#example').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{{ url('create') }}',
				columns: [
					{ data: 'id' },
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
				$('#sart_date').val(data.employment_date);
				$('#salary').val(data.salary);
				$('#manger_id').val(data.parent_id);
			});

			$('#example tbody').on( 'click', 'tr', function () {
				if ( $(this).hasClass('table-primary') ) {
					$(this).removeClass('table-primary');
					$('#edit').attr("disabled", true);
				}
				else {
					table.$('tr.table-primary').removeClass('table-primary');
					$(this).addClass('table-primary');
					$('#edit').attr("disabled", false);
				}
			});

			// $('#edit').on('click', function () {

   //      table.row.add([
   //        { data: 'id' },
			// 		{ data: 'fio' },
			// 		{ data: 'position' },
			// 		{ data: 'employment_date' },
			// 		{ data: 'salary' },
			// 		{ data: 'parent_id' }
   //      ]).draw( false );
 	 //    });

			$('#remove').click( function () {
				table.row('.table-primary').remove().draw( false );
			});

		});
	</script>
@endpush
