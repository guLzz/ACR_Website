@extends('layouts.app')

@section('content')

    $type;
    <div>
        <!--@foreach($events as $event)-->
            <li>
                <img src="../something" >
                <h1>  $event['title']  </h1>
                <p> $type </p>



                <!--@if(hasRole('User'))
                    <input type="button" value="Book Now">
                @endif
                @if(Auth::hasRole('Admin'))
                    EDIT INFO
                @endif-->
            </li>
    </div>

@endsection