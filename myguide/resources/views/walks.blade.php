@extends('layouts.app')

@section('content')

    <div>
        @foreach($events as $event)
            <li>
                <img src="../something" >
                <h1>  $event['title']  </h1>
                <p> DESCRICAO </p>
                @if(Auth::user->hasRole('User') || Auth::user->hasRole('Admin'))
                    <input type="button" value="Book Now">
            </li>
    </div>

@endsection