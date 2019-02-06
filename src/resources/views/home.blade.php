@extends('layouts.app')

@section('content')
<div class="container">
	<table id="example" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>id</th>
				<th>fio</th>
				<th>position</th>
				<th>salary</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>id</th>
				<th>fio</th>
				<th>position</th>
				<th>salary</th>
			</tr>
		</tfoot>
	</table>
</div>

<script>
	var data = {!! $data !!};
</script>

@endsection

@push('scripts')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript" src="{{ asset('js/staff_table.js') }}"></script>
@endpush
