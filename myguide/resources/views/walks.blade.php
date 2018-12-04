@extends('layouts.app')

@section('content')

    <div>
        @foreach($events as $event)
            <li>
                <img src="" alt="">
                <h1>    </h1>
                <p></p>
                @if(Auth::user->hasRole('User') || Auth::user->hasRole('Admin'))
                    <input type="button" value="Book Now">
            </li>
    </div>

@endsection