@extends('layouts.app')

@section('content')
    <div>
		<div>
            @if($user = Auth::user())
                @if(Auth::user()->role == 'User')
                    <h1>Choose your Journey</h1>
                    <form action="/bundle/" method = "POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <?php $i=0;  ?>
                        @foreach($events as $type)
                            <h3>{{$type[0]->events_type_type}}</h3>  
                            @foreach($type as $event)
                                @if( $current_pax[$i] < $event->nr_pax)
                                    <input type="checkbox" name="event_id[]" value="{{$event->id}}"> {{$event->name}} Current PAX:  {{$current_pax[$i]}} / {{$event->nr_pax}} <br>                             
                                @else
                                    <p> {{$event->name}} This Event has reached the maximum capacity </p>
                                @endif
                                <?php $i++;  ?>
                            @endforeach
                        @endforeach
                        <!--<p>Number of Persons</p>
                        <input type="number" min="1" max = "{{min($max_pax) - min($current_pax)}}" name="number_pax"/> -->												
                        <button type= "submit"> Check-in </button>
                    </form>
                @else
                    <h3>You Must be a User to Use this!!</h3>
                @endif
            @else
                <h3>You Must be a User to Use this!! Please register</h3>
            @endif
        </div>
	</div>
	
@endsection