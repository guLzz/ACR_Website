@extends('layouts.app')

@section('content')
    <div>
        @if($user = Auth::user())
            @if(Auth::user()->role == 'User')
				@if(!empty($events))
					<h1>Share your Thoughts</h1>
					<form action="/reviews/" method = "POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <select name="events_id" id=""> <!--seleciona o evento pretendido para avaliar-->
                            <option value="" disabled selected> Choose Event </option>
                            @foreach($events as $event)
                                <option value="{{$event->id}}">{{$event->name}}</option>
                            @endforeach
                        </select>
                        <textarea id="text-box" style = "height:200px;width:500px;" name = "textbox"> </textarea>
                        <input type="file" name = "type_pic" onchange="uploadPic()">
                        <br><br>
                        <img src="" height="200" width="200" alt="Image preview">
                        <br><br>
                        <button type= "submit"> Review Us </button>
                    </form>
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
					<hr>
					<br>
				@endif	
            @endif
        @endif
    </div>
    <div>
		<ul>
			@foreach($reviews as $review)  
				<li>
					<h3>Date: {{$review->created_at}}  Event: {{$review->events_name}} User: {{$review->users_name}}</h3>
					<img src="{{ asset('/images/gallery/'.$review->pic)}}" height="200" width="200" class = "review-img">
					<textarea readonly class = "textarea-readable"> {{$review->reviewtext}} </textarea>						
				</li>
			@endforeach
		</ul>		
    </div>
@endsection