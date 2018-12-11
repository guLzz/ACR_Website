@extends('layouts.app')

@section('content')
    
    <div>
        <div>
			<ul>
				@foreach($events as $event)  <!--imprimir os eventos existentes junto com as suas imagens, !!!!!!falta apenas mostrar eventos depois da data atual!!!!-->
					<li>
                        <h1>  {{$event->name}}  </h1>
						<img src="../{{$event->pic}}" >
                        <h3>  {{$event->about}}  </h3>						
						<h3> Max PAX: {{$event->nr_pax}} </h3>
						<h3> Price: {{$event->price}} </h3>
						<button onclick = "book()"> Book Now </button> <!--API DO PAYPAL-->
					</li>
				@endforeach
			</ul>			
		</div>
    </div>

@endsection