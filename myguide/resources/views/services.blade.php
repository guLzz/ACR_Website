@extends('layouts.app')

@section('content')

	<div>
		<div>
			@if($user = Auth::user())
            	@if(Auth::user()->role == 'Admin')
					<input type="text">
					<button onclick = "addEventType()"> Add Event</button>
					<br>
					<hr>
				@endif
			@endif
		</div>
		<div class = "image-line">
			@foreach($types as $type)  <!--FALTA VER O URL!!!!-->
				<a href="{{ url('/services/events', [ 'id' => $type->id ])}}"> <img src="../{{$type->type}}" height="200" width="200" > {{$type->type}} </a>
			@endforeach
			<a href="{{ url('/services/bundle') }}"> <img src="../something" height="200" width="200"> Bundle </a>
	</div>
	</div>

	

@endsection