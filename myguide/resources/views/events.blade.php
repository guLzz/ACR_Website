@extends('layouts.app')

@section('content')
    <div>
        <div>
			@if($user = Auth::user())
            	@if(Auth::user()->role == 'Admin')
					<form action="/services/{type}/" method = "POST" enctype="multipart/form-data">	                       									
						<input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <input type="hidden" name="type_id" value = "{{$type_id}}">
                        <input type="hidden" name="type_type" value = "{{$type_type}}">
                        <p>Upload Event Image</p>
                        <input type="file" name = "type_pic" onchange="uploadPic()">
                        <br><br>
                        <img src="" height="200" width="200" alt="Image preview">
                        <br><br>
                        <p>Name:</p>
                        <input type="text" name = "name">
                        <br><br>
                        <p>About:</p>
                        <textarea id="text-box" style = "height:200px;width:500px;" name = "about"> </textarea>
                        <br>
                        <p>Price:</p>
                        <input type="number" name = "price">
                        <br>
                        <p>Date:</p>
                        <input type="date" name = "date">
                        <br>
                        <p>Number of Persons(MAX):</p>
                        <input type="number" name = "nr_pax">
						<br>
                        <button type= "submit"> Add new Event </button>
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
		<div>
			<ul>
				@foreach($events as $event)  <!--imprimir os eventos existentes junto com as suas imagens, !!!!!!falta apenas mostrar eventos depois da data atual!!!!-->
					<li>
						<img src="{{ asset('/images/events/'.$event->pic)}}" >
						<h1>  {{$event->name}}  </h1>
						<h3> Max PAX: {{$event->nr_pax}} </h3>
						<h3> Price: {{$event->price}} </h3>
						<a href="{{$event->events_type_type}}/{{$event->id}}"> More Info</a> <!--View com mais info desse evento especifico-->
						<button onclick = "book()"> Book Now </button> <!--API DO PAYPAL-->
					</li>
				@endforeach
			</ul>			
		</div>

		<div>
			<!--fazer formulario aqui para admin inserir mais eventos-->
			@if($user = Auth::user())
            	@if(Auth::user()->role == 'User')
					<h2> Add new Event </h2>
					<form method = "POST" action="/events/">
						<button onclick = "uploadImage()"> Upload Image </button>
						<input type="text"  id=""> <!--name-->
						<textarea id="text-box" style = "height:200px;width:500px;"> </textarea> <!--about-->
						<input type="text"  id=""> <!--price-->
						<input type="text"  id=""> <!--nr_pax-->
						<input type="datetime" name="" id=""><!--data--->
						<button onclick = "addEvent()" type = "submit"> Add new </button>
					</form>
				@endif
			@endif		
		</div>
	</div>

@endsection