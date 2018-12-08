@extends('layouts.app')

@section('content')

	<p> The value I passed is: {{ $events }} </p> <!--debug-->
    <div>
		<div>
			@foreach($events as $event)  <!--imprimir os eventos existentes junto com as suas imagens, !!!!!!falta apenas mostrar eventos depois da data atual!!!!-->
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

		<div>
			<!--fazer formulario aqui para admin inserir mais eventos-->
			@if($user = Auth::user())
            	@if(Auth::user()->role == 'User')
					<h2> Add new Event </h2>
					<form action="">
						<button onclick = "uploadImage()"> Upload Image </button>
						<input type="text"  id=""> <!--name-->
						<textarea id="text-box" style = "height:200px;width:500px;"> </textarea> <!--about-->
						<input type="text"  id=""> <!--price-->
						<input type="text"  id=""> <!--nr_pax-->
						<input type="datetime" name="" id=""><!--data--->
						<button onclick = "addEvent()"> Add new </button>
					</form>
				@endif
			@endif		
		</div>
	</div>

@endsection