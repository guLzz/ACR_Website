@extends('layouts.app')

@section('content')
    <div class="txt-center back-color">
        <div>
			@if($user = Auth::user())
                @if(Auth::user()->role == 'Admin')
                        @if (session('alert'))
                        <div class="alert alert-success">
                        {{ session('alert') }}
                        </div>
                        @endif
                    <form action="/services/{type}/" method = "POST" enctype="multipart/form-data">	
                        <table class="insert-table">                       									
                        <input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <input type="hidden" name="type_id" value = "{{$type_id}}">
                        <input type="hidden" name="type_type" value = "{{$type_type}}">
						<tr>
                            <td class="field-type">
                                <p>Name:</p>
                            </td>
                            <td class="field-type">
                                <input type="text" name = "name" required>
                            </td>
                        </tr>
						
						<tr>
							<td colspan = "2" style="text-align:center;">
                                <img src="" height="200" width="200" alt="Image preview">
                            </td>
						</tr>
						<tr>
							<td colspan = "2" style="text-align:center;">
                                <p>Upload Event Image</p>
                            </td>
						</tr>
						<tr>
                            <td colspan = "2" style="text-align:center;">
                                <input type="file" name = "type_pic" onchange="uploadPic()" required>
                            </td>
                        </tr>
                        

                        <tr>
                            <td>
                                <p>About:</p>
                            </td>
                            <td>
								<label for="text-box">No more than 150 characters</label><br>
                                <textarea id="text-box" style = "height:200px;width:500px;" name = "about" maxlength = "150" required> </textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <p>Price:</p>
                            </td>
                            <td colspan = "2">
                                <input type="number" step="0.01" name = "price" required>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Date:</label>
                            </td>
                            <td colspan = "2">
                                <p>Example: 2018-06-12T19:30</p>
                                <input type="datetime-local" name = "date" required>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <p>Number of Persons(MAX):</p>
                            </td>
                            <td colspan = "2">
                                <input type="number" name = "nr_pax" required>
                            </td>
                        </tr>

                        <tr>
                            <td colspan = "2" style="text-align:center;">
                                <button type= "submit"> Add new Event </button>
                            </td>
                        </tr>  
                        </table>                                 
                    </form>                  
					<br>
                    <hr>
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
		    <div>
				@foreach($events as $event)  
					<ul>
                        <table class="event-table">
                            <tr><td rowspan = "6"><img src="{{ asset('/images/events/'.$event->pic)}}" height="200" width="200" ></td>
                            <tr><td><h1><strong> {{$event->name}} </strong></h1></td></tr>
                            <tr><td><h3> Max PAX: {{$event->nr_pax}} </h3></td></tr>
                            <tr><td><h3> Price: {{$event->price}} $ </h3></td></tr>
                            <tr><td><h3> Date: {{$event->date}} </h3></td></tr>
                            <tr><td ><h3><a href="{{$event->events_type_type}}/{{$event->id}}"> More Info</a></h3></td></tr>
                        </table>
					</ul>
				@endforeach
			</ul>			
		</div>
	</div>

@endsection