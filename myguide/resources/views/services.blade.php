@extends('layouts.app')

@section('content')

	<div class = "image-line">
		@foreach($types as $type)  <!--imprimir os eventos existentes junto com as suas imagens-->
			<a href="{{ route('/services/events', [ 'type' => $type->type ])}}"> <img src="../{{$type->type}}" height="200" width="200" > {{$type->type}} </a>
		@endforeach
		<a href="{{ url('/services/bundle') }}"> <img src="../something" height="200" width="200"> Bundle </a>
	</div>

@endsection