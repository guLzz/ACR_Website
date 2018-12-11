@extends('layouts.app')

@section('content')

	<div>
		<div>
			@if($user = Auth::user())
            	@if(Auth::user()->role == 'Admin')
					<form action="/services/" method = "POST">											
						<input type="hidden" name="_token" value ="{{csrf_token()}}">
						<input type="text" name = "type">
						<button type= "submit"> Add new Type </button>
					</form>
					<br>
					<hr>
				@endif
			@endif
		</div>
		<div class = "image-line">
			@foreach($types as $type)  <!--FALTA VER O URL!!!!-->
				<a href="services/{{$type->type}}"> <img src="../{{$type->type}}" height="200" width="200" > {{$type->type}} </a>
			@endforeach
			<a href="{{ url('/services/bundle') }}"> <img src="../something" height="200" width="200"> Bundle </a>
		</div>
	</div>

	

@endsection