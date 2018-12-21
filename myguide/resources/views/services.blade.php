@extends('layouts.app')

@section('content')
	<div>
		<div>
			@if($user = Auth::user())
            	@if(Auth::user()->role == 'Admin')
					<form action="/services/" method = "POST" enctype="multipart/form-data">	                       									
						<input type="hidden" name="_token" value ="{{csrf_token()}}">
						<p>Type:</p>
                        <input type="text" name = "type">
                        <br><br>
                        <p>Upload Type Image</p>
                        <input type="file" name = "type_pic" onchange="uploadPic()">
                        <br><br>
                        <img src="" height="200" width="200" alt="Image preview">
						<br>
                        <button type= "submit"> Add new Type </button>
					</form>
					<br>
				@endif
			@endif
            <script>
                function uploadPic(){
                    var preview = document.querySelector('img'); 
                    var file    = document.querySelector('input[type=file]').files[0]; 
                    var reader  = new FileReader();

                    reader.onloadend = function () {
                        preview.src = reader.result;
                    }

                    if (file) {
                        reader.readAsDataURL(file); 
                    } else {
                        preview.src = "";
                    }
                }

                uploadPic();  
            </script>
		</div>
        <hr>
		<div class = "image-line">
			@foreach($types as $type)        
			    <a href="services/{{$type->type}}"><img src="{{ asset('/images/types/'.$type->pic)}}" alt = "Can't Load" height="200" width="200" > {{$type->type}} </a>
			@endforeach
			<a href="{{ url('/services/bundle') }}"> <img src="../something" height="200" width="200"> Bundle </a>
		</div>
	</div>


	

@endsection