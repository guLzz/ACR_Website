@extends('layouts.app')

@section('content')
	<div>
		<div>
			@if($user = Auth::user())
            	@if(Auth::user()->role == 'Admin')
					<form action="/services/" method = "POST" enctype="multipart/form-data">
                        <table>                        	                       									
                            <input type="hidden" name="_token" value ="{{csrf_token()}}">
                            <tr>
                                <td>
                                    <p>Type:</p>
                                </td>
                                <td>
                                    <input type="text" name = "type" required>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2" style="text-align:center;">
                                <img src="" height="200" width="200" alt="Image preview">
                                </td>
							</tr>
							<tr>
								<td colspan = "2" style="text-align:center;">
                                <p>Upload Type Image</p>
                                </td>
							</tr>
							<tr>
                                <td colspan = "2" style="text-align:center;">
                                <input type="file" name = "type_pic" onchange="uploadPic()" required>
                                </td>
							</tr>
                            <tr>
                                <td colspan = "2" style="text-align:center;">
                                    <button type= "submit">Add new Type</button>
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
		<div class = "image-line">
            <table> 
                <tr>
                    @foreach($types as $type)
                            <td style="text-align:center;">
                                <a href="services/{{$type->type}}"><img src="{{ asset('/images/types/'.$type->pic)}}" alt = "Can't Load" height="200" width="200" > {{$type->type}} </a>                       
                        @if($user = Auth::user())
                            @if(Auth::user()->role == 'Admin')
                                <form action="/services/delete/" method = "POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value ="{{csrf_token()}}">
                                    <input type="hidden" name="type_id" value ="{{$type->id}}">
                                    <button type= "submit"> <img src="{{ asset('/images/utility/delete.png')}}" alt="Dlt" height="20" width="20"> </button>
                                    </td>
                                </form>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <a href="{{ url('/bundle') }}"> <img src="{{ asset('/images/utility/bundle.png')}}" height="200" width="200"> bundle </a>
                    </td>
                </tr>
            </table>    
        </div>
	</div>


	

@endsection