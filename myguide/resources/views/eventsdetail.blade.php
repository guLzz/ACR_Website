@extends('layouts.app')

@section('content')
    
    <div>
        <div>
			<ul>
				@foreach($events as $event)  <!--imprimir os eventos existentes junto com as suas imagens, !!!!!!falta apenas mostrar eventos depois da data atual!!!!-->
					<li>
                        <h1>  {{$event->name}}  </h1>
						<img src="{{ asset('/images/events/'.$event->pic)}}" >
                        <h3>  {{$event->about}}  </h3>						
						<h3> Current PAX:  {{count($current_pax)}} / {{$event->nr_pax}} </h3>
						<h3> Price: {{$event->price}} $ </h3>
                        @if(count($current_pax) < $event->nr_pax)
                            @if($user = Auth::user())
                                @if(Auth::user()->role == 'User')
                                    <form action="/services/{type}/{id}/" method = "POST">	
                                        <input type="hidden" name="event_id" value = "{{$event->id}}">
                                        <input type="hidden" name="type_type" value = "{{$event->events_type_type}}">
                                        <button type= "submit"> Book Now </button>
                                    </form>
                                @endif
                            @endif 
                        @else
                            <h3> This Event has reached the maximum capacity </h3>
                        @endif
                        @if(Auth::guest())
                            <h3>Login to Book your Activity!</h3>
                        @endif
					</li>
				@endforeach
			</ul>			
		</div>
    </div>

@endsection