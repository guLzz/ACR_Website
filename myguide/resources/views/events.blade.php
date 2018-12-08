@extends('layouts.app')

@section('content')

	<p> The value I passed is: {{ $events }} </p>
    <div>
		@foreach($events as $event)  <!--imprimir os eventos existentes junto com as suas imagens-->
			<li>
				<img src="../{{$event->pic}}" >
				<h1>  {{$event->name}}  </h1>
				<h3> Max PAX: {{$event->nr_pax}} </h3>
				<h3> Price: {{$event->price}} </h3>
				<button onclick = "moreInfo()"> More Info </button> <!--View com mais info desse evento especifico-->
				<button onclick = "book()"> Book Now </button> <!--API DO PAYPAL-->
			</li>
		@endforeach
    </div>

@endsection