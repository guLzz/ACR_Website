@extends('layouts.app')

@section('content')

    <div class = "image-line">
        <a href="{{ url('/services/walks') }}"> <img src="../something" height="200" width="200" > Walks </a>
        <a href="{{ url('/services/tours') }}"> <img src="../something" height="200" width="200"> Tours </a>
        <a href="{{ url('/services/boat') }}"> <img src="../something" height="200" width="200"> Boat </a>
        <a href="{{ url('/services/bundle') }}"> <img src="../something" height="200" width="200"> Bundle </a>
    </div>

@endsection