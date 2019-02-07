@extends('layouts.app')

@section('content')
<div class="container">
	<table id="example" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th style="width: 15px;">ID</th>
				<th style="width: 150px;">Name</th>
				<th>Position</th>
				<th style="width: 100px;">Start Date</th>
				<th style="width: 100px;">Salary</th>
				<th style="width: 150px;">Manager Name</th>
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
				<th>Manager Name</th>
				<th>Manager Id</th>
			</tr>
		</tfoot>
	</table>
</div>

@endsection

@push('scripts')
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/datatables.min.js"></script>

  <script>
  	$(document).ready(function() {
  		$('#example').DataTable({
  			processing: true,
  			serverSide: true,
  			ajax: '{{ url('create') }}',
  			columns: [
  				{ data: 'id' },
  				{ data: 'fio' },
  				{ data: 'position' },
  				{ data: 'employment_date' },
  				{ data: 'salary' },
  				{ data: 'manager_name' },
  				{ data: 'parent_id' },
  			]
  		});
  	});
  </script>
@endpush


