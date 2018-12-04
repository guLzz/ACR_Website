@extends('layouts.app')

@section('content')

    <div class = "image-line">
        <a href="{{ url('/services/walks') }}"> <img src="../something" > Walks </a>
        <a href="{{ url('/services/tours') }}"> <img src="../something" > Tours </a>
        <a href="{{ url('/services/boat') }}"> <img src="../something" > Boat </a>
        <a href="{{ url('/services/bundle') }}"> <img src="../something" > Bundle </a>
    </div>

@endsection