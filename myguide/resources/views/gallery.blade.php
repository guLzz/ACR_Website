@extends('layouts.app')

@section('content')
    <div>
        @if($user = Auth::user())
            @if(Auth::user()->role == 'User' || Auth::user()->role == 'Admin')
                <h1>Share your Experiences with the World!</h1>
                <button onclick = "uploadPic()" class = "my-button"> Upload </button>
            @endif
        @endif
    </div>
    <hr>
    <div>
        <!--imagens pequenas, quando clicamos ampliam com hipotese de passar para a proxima-->
        <!--for each para cobrir todas as imagens existentes
        <img src="imagem pequena" onclick = "zoom()" height="200" width="200">-->

		@foreach($images as $image)  <!--imprimir os eventos existentes junto com as suas imagens-->
			<img src="../$image->name" onclick = "zoom()" height="200" width="200">
		@endforeach
    </div>
@endsection