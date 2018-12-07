@extends('layouts.app')

@section('content')
    <div>
        @if($user = Auth::user())
            @if(Auth::user()->role == 'User' || Auth::user()->role == 'Admin')
                <h1>HEADER AQUI</h1>
                <img src="../something" height="200" width="200" class = "review-img">
                <button onclick = "uploadPic()" class = "my-button"> Upload </button>
                <textarea id="text-box" style = "height:200px;width:500px;"> </textarea>
                <button onclick = "addReview()" class = "my-button"> Review </button>
            @endif
        @endif
    </div>
    <hr>
    <div>
    <!--por o foreach aqui-->
        <img src="vai buscar a tabela " height="200" width="200" class = "review-img">
        <h3>data da review</h3>
        <textarea readonly class = "textarea-readable">vai buscar o conteudo, fazer css depois</textarea> 
    </div>
@endsection