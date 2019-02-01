@extends('layouts.app')

@section('content')

	<div id="chart-container"></div>
	<script>
    var employees = {!! $employees !!};
    employees = employees[0];
	</script>

@endsection
