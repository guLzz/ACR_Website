@extends('layouts.app')

@section('content')

    <div>
        <div>
            @if(Auth::user()->role == 'User')
                <h1> Track your events! </h1>
                <table border = "1">
                    <tr>
                        <th>Atendeed Events</th>
                    </tr>
                    @foreach($oldevents as $oldevent)
                    <tr>
                        <td rowspan="2"> Date: {{$oldevent->date}} <br> {{$oldevent->name}} </td>
                    </tr>
                    @endforeach
                </table>
                <br>
                <table border = "1">
                    <tr>
                        <th>Upcoming Events</th>
                    </tr>
                    @foreach($newevents as $newevent)
                    <tr>
                        <td> Date: {{$newevent->date}} <br> {{$newevent->name}} </td>
                    </tr>
                    @endforeach    
                </table>
                @endif
                @if(Auth::user()->role == 'Admin')
                    <h1> Track your next events! </h1>
                    <table border = "1">
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
