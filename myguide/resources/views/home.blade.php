@extends('layouts.app')

@section('content')

    <div>
        <div>
            @if(Auth::user()->role == 'User')
                <h1 style="text-align: center;"> Track your events! </h1>
				<section class="sides">				
					<div class="left">
						<table border = "1" style="margin-left: auto;margin-right: auto;">
								<tr>
									<th>Atendeed Events</th>
								</tr>
								@foreach($oldevents as $oldevent)
								<tr>
									<td> Date: {{$oldevent->date}} <br> {{$oldevent->name}} </td>
								</tr>
								@endforeach
						</table>
					</div>
					<br>
					<div class="right">
						<table border = "1" style="margin-left: auto;margin-right: auto;">
								<tr>
									<th>Upcoming Events</th>
								</tr>
								@foreach($newevents as $newevent)
								<tr>
									<td> Date: {{$newevent->date}} <br> {{$newevent->name}} </td>
								</tr>
								@endforeach    
						</table>
					</div>
				</section>
            @endif
			@if(Auth::user()->role == 'Admin')
				<h1 style="text-align: center;"> Track your next events! </h1>
				<table border = "1" style="margin-left: auto;margin-right: auto;">
					<tr>
						<th>Date</th>
						<th>Event</th>
						<th>Number PAX</th>
					</tr>
					@foreach($adminevents as $adminevent)
					<tr>
						<td> {{$adminevent->date}} </td>
						<td> {{$adminevent->name}} </td>
						<td> {{$adminevent->nr_pax}} </td>
					</tr>
					@endforeach    
				</table>
			@endif
        </div>
    </div>

@endsection
