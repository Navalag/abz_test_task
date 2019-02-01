@extends('layouts.app')

@section('content')

	<div id="chart-container"></div>
	<script>
    var levelOne = {!! $levelOne !!};
    var levelTwo = {!! $levelTwo !!};
    var levelThree = {!! $levelThree !!};
    // console.log(levelThree);
	</script>

@endsection
