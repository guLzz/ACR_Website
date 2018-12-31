@extends('layouts.app')

@section('content')
    
    <div>
        <div>
            @foreach($events as $event)  
                @if($user = Auth::user())
                    @if(Auth::user()->role == 'Admin')
                        <form action="/services/{type}/{id}/delete/" method = "POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value ="{{csrf_token()}}">
                            <input type="hidden" name="event_id" value ="{{$event->id}}">
                            <input type="hidden" name="type_name" value = "{{$event->events_type_type}}">
                            <button type= "submit"> <img src="{{ asset('/images/utility/delete.png')}}" alt="Dlt" height="20" width="20"> </button>
                        </form>
                    @endif
                @endif 
                <h1>  {{$event->name}}  </h1>
                <img src="{{ asset('/images/events/'.$event->pic)}}" >
                <h3>  {{$event->about}}  </h3>						
                <h3> Current PAX:  {{count($current_pax)}} / {{$event->nr_pax}} </h3>
                <h3> Price: {{$event->price}} $ / Pax </h3>
                @if(count($current_pax) < $event->nr_pax)
                    @if($user = Auth::user())
                        @if(Auth::user()->role == 'User')
                            <form action="/services/{type}/{id}/" method = "POST" enctype="multipart/form-data">	
                                <input type="hidden" name="_token" value ="{{csrf_token()}}">
                                <p>Number of Persons</p>
                                <input type="number" min="1" max="{{$event->nr_pax - count($current_pax)}}" name="number_pax"/> <!--Deixa user escolher quantas pessoas quer levar-->		
                                <input type="hidden" name="events_id" value = "{{$event->id}}">
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
            @endforeach			
		</div>
    </div>

@endsection