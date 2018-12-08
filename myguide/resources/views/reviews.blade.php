@extends('layouts.app')

@section('content')
    <div>
        @if($user = Auth::user())
            @if(Auth::user()->role == 'User' || Auth::user()->role == 'Admin')
                <h1>Share your Thoughs</h1>
                <button onclick = "uploadPic()" class = "my-button"> Upload </button>
                <textarea id="text-box" style = "height:200px;width:500px;"> </textarea>
                <button onclick = "addReview()" class = "my-button"> Review </button>
            @endif
        @endif
    </div>
    <hr>
    <div>
    <!--por o foreach aqui
        <img src="vai buscar a tabela " height="200" width="200" class = "review-img">
        <h3>data da review</h3>
        <textarea readonly class = "textarea-readable">vai buscar o conteudo, fazer css depois</textarea>--> 

		@foreach($reviews as $review)  <!--imprimir os eventos existentes junto com as suas imagens-->
			<li>
				<img src="../{{$review->pic}} " height="200" width="200" class = "review-img">
				<h3>Date: {{$review->timestamps}}  Event: {{$review->events_name}}</h3>
				<textarea readonly class = "textarea-readable"> {{$review->reviewtext}} </textarea>
			</li>
		@endforeach

    </div>
@endsection