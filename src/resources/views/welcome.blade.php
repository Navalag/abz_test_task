@extends('layouts.app')

@section('content')
	<div class="d-flex justify-content-center loader">
		<div class="spinner-border text-warning" style="width: 3rem; height: 3rem;" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	<div id="chart-container"></div>
	<script>
		var employees = {!! $employees !!};
		employees = employees[0];
	</script>

@endsection

@push('scripts')
	<!--  OrgChart JS -->
	<!-- <script type="text/javascript" src="{{ asset('vendor/org_chart/jquery.min.js') }}"></script> -->
	<script type="text/javascript" src="{{ asset('vendor/org_chart/jquery.orgchart.js') }}"></script>
	<!-- Main Chart File -->
	<script type="text/javascript" src="{{ asset('js/org_chart.js') }}"></script>
@endpush
