@extends('layouts.app')

@section('content')

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
