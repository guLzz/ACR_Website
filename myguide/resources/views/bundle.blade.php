@extends('layouts.app')

@section('content')
		<div class="txt-center back-color">
            @if(!empty($events))
                @if($user = Auth::user())
                    @if(Auth::user()->role == 'User')
                        <h1>Choose your Journey</h1>
                            <form action="/bundle/" method = "POST" enctype="multipart/form-data">
                                <table class="event-table">    
                                   <input type="hidden" name="_token" value ="{{csrf_token()}}">
                                    <?php $i=0;  ?>
                                    @foreach($events as $type)
                                        <tr>
                                            <th><h3>{{$type[0]->events_type_type}}</h3></th>
                                        </tr>  
                                        @foreach($type as $event)
                                            @if( $current_pax[$i] < $event->nr_pax)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="event_id[]" value="{{$event->id}}"> {{$event->name}} Current PAX:  {{$current_pax[$i]}} / {{$event->nr_pax}}                                                      
                                                </td>
                                            </tr>
                                                @else
                                            <tr>
                                                <td>
                                                    <p> {{$event->name}} This Event has reached the maximum capacity </p>
                                                </td>
                                            </tr>
                                                
                                            @endif
                                            <?php $i++;  ?>
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td colspan = "2"><button type= "submit"> Check-in </button></td>
                                    </tr>
                                    </table>        
                                </form>
                            
                    @else
                        <h3 style="padding-top:20px;">You Must be a User to Use this!!</h3>
                    @endif
                @else
                    <h3 style="padding-top:20px;">You Must be a User to Use this!! Please register</h3>
                @endif
            @else
                <h3>No Events to create a Bundle</h3>
            @endif
        </div>
	
@endsection