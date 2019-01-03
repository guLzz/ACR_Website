@extends('layouts.app')

@section('content')
        <div class="txt-center back-color">
            @if(Auth::user()->role == 'User')
                <h1 style="text-allign:center; padding-top: 20px;"> Track your events! </h1>
				<div>				
						<table class="boxy">
								<tr>
									<th>Atendeed Events</th>
								</tr>
								@foreach($oldevents as $oldevent)
								<tr>
									<td> Date: {{$oldevent->date}} <br> {{$oldevent->name}} </td>
								</tr>
								@endforeach
						</table>
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
            @endif
			@if(Auth::user()->role == 'Admin')
				<h1 style="text-align: center; padding-top:20px;"> Track your next events! </h1>
				<table class="admin-table">
					<tr>
						<th>Date</th>
						<th>Event</th>
						<th>Number PAX</th>
						<th>Profit</th>
					</tr>
					<?php $i=0; ?>
					@foreach($adminevents as $adminevent)
					<tr>
						<td> {{$adminevent->date}} </td>
						<td> {{$adminevent->name}} </td>
						<td> {{count($current_pax[$i])}} </td>
						<td> {{$adminevent->price * count($current_pax[$i]) }}$ </td>
					</tr>
					<?php $i++; ?>
					@endforeach    
				</table>
			@endif
        </div>

@endsection
