@extends('layouts.app')

@section('content')
<div class="container">
	@if ($errors->any())
		<div class="alert alert-danger" role="alert">
			@foreach ($errors->all(':message') as $message)
				<p class="mb-1">{{ $message }}</p>
			@endforeach
		</div>
	@endif
	<button type="button" id="add" class="btn btn-outline-success btn-sm mb-3" data-toggle="modal" data-target="#modalCreate">Add</button>
	<button type="button" id="edit" class="btn btn-outline-secondary btn-sm mb-3" data-toggle="modal" data-target="#modalEdit" disabled>Edit</button>
	<button type="button" id="remove" class="btn btn-outline-danger btn-sm mb-3" data-toggle="modal" data-target="#modalDelete" disabled>Delete</button>
	<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>img</th>
				<th>Name</th>
				<th>Position</th>
				<th>Start Date</th>
				<th>Salary</th>
				<th>Manager Id</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>ID</th>
				<th>img</th>
				<th>Name</th>
				<th>Position</th>
				<th>Start Date</th>
				<th>Salary</th>
				<th>Manager Id</th>
			</tr>
		</tfoot>
	</table>
</div>

<!-- Edit Row Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit selected row</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('edit.row') }}"  id="formEditRow">
					@csrf

					<div id="alertNotification"></div>
					<div class="form-group">
						<label for="name">Upload Avatar</label>
						<input type="file" name="image_url" id="uploadAvatar" class="form-control">
					</div>
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" id="name" placeholder="Name">
					</div>
					<div class="form-group">
						<label for="position">Position</label>
						<input type="text" name="position" class="form-control" id="position" placeholder="Position">
					</div>
					<div class="form-group">
						<label for="start_date">Start Date</label>
						<input type="text" name="start_date" class="form-control" id="start_date">
					</div>
					<div class="form-group">
						<label for="salary">Salary</label>
						<input type="number" name="salary" step="1" class="form-control" id="salary" placeholder="Salary">
					</div>
					<div class="form-group">
						<label for="manger_id">Manager Id</label>
						<input type="number" name="manger_id" step="1" class="form-control" id="manger_id" placeholder="Manager Id">
					</div>
					<input type="hidden" id="person_id" name="id">
					<button type="submit" id="editRow" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Create New Row Modal -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreate" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Create New Row</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('create.row') }}"  id="formEditRow">
					@csrf

					<div id="alertNotification"></div>
					<div class="form-group">
						<label for="name1">Name</label>
						<input type="text" name="name" class="form-control" id="name1" placeholder="Name">
					</div>
					<div class="form-group">
						<label for="position1">Position</label>
						<input type="text" name="position" class="form-control" id="position1" placeholder="Position">
					</div>
					<div class="form-group">
						<label for="start_date1">Start Date</label>
						<input type="text" name="start_date" class="form-control" id="start_date1">
					</div>
					<div class="form-group">
						<label for="salary1">Salary</label>
						<input type="number" name="salary" step="1" class="form-control" id="salary1" placeholder="Salary">
					</div>
					<div class="form-group">
						<label for="manger_id1">Manager Id</label>
						<input type="number" name="manger_id" step="1" class="form-control" id="manger_id1" placeholder="Manager Id">
					</div>
					<button type="submit" id="createRow" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Delete Row Modal -->
<div class="modal fade bd-example-modal-sm" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<div id="alertNotificationDelete"></div>
				<p class="mb-3">Caution! If you delete manager all employees behind him will also be deleted!</p>
				<p>Are you sure you want to delete this row?</p>
				<button type="button" id="deleteRow" class="btn btn-danger btn-block">Yes</button>
				<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/datatables.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/staff_table.js') }}"></script>
@endpush
