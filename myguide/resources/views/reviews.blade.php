@extends('layouts.app')

@section('content')
    <div>
        @if($user = Auth::user())
            @if(Auth::user()->role == 'User')
				@if(!empty($events))
					<h1 style="text-align: center;">Share your Thoughts</h1>
					<form action="/reviews/" method = "POST" enctype="multipart/form-data" style="text-align: center;">
                        <input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <div class="boxy">
							<div class="left">
								<select name="events_id" id="" required> <!--seleciona o evento pretendido para avaliar-->
									<option value="" disabled selected> Choose Event </option>
									@foreach($events as $event)
										<option value="{{$event->id}}">{{$event->name}}</option>
									@endforeach
								</select><br><br>
															
								<div class="rating">
									<input id="star5" name="rating" type="radio" value="5" class="radio-btn hide" required>
									<label for="star5" >☆</label>
									<input id="star4" name="rating" type="radio" value="4" class="radio-btn hide" >
									<label for="star4" >☆</label>
									<input id="star3" name="rating" type="radio" value="3" class="radio-btn hide" >
									<label for="star3" >☆</label>
									<input id="star2" name="rating" type="radio" value="2" class="radio-btn hide" >
									<label for="star2" >☆</label>
									<input id="star1" name="rating" type="radio" value="1" class="radio-btn hide" >
									<label for="star1" >☆</label>
									<div class="clear"></div>
								</div><br>						
								<br>
								<label for="text-box">No more than 150 characters</label><br>
								<textarea id="text-box" style = "height:200px;width:500px;" name = "textbox" maxlength = "150"> </textarea>
								<br>
								<button type= "submit" style="float:right;"> Review Us </button>
							</div>
							<div class="right">
								<table border="1">
									<tr>
										<td style="text-align:center;">									
											<img src="" height="200" width="200" alt="Image preview">
										</td>
									</tr>
									<tr>
										<td style="text-align:center;">
											<p>Upload Event Image</p>
										</td>
									</tr>
									<tr>
										<td style="text-align:center;">
											<label for="upload-pic">Not Required</label><br>
											<input id ="upload-pic" type="file" name = "type_pic" onchange="uploadPic()" >
										</td>                           
									</tr>
								</table>
							</div>
							<br>
                        </div>
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
                    
					
					<br>
				@endif	
            @endif
        @endif
    </div>
    <div>
		<div>
            @if($user = Auth::user())
                @if(Auth::user()->role == 'User' || Auth::user()->role == 'Admin')
                    @if($averageRating > 0)
                        <table>
                            <th colspan ="2" style="text-align:center;"><h1>Average Rating</h1></th>
                            <tr style="text-align:center;">
                                <td>
                                    Number of Reviews: {{count($reviews)}}
                                </td>
                                <td>
                                    @for($i = 1; $i <= $averageRating; $i++)
                                            <img src="{{ asset('/images/utility/starchecked.png')}}" height="20" width="20" alt="error loading">
                                    @endfor
                                    <?php  $missingstars = 5 - $averageRating;  ?>
                                    @for($j = 1; $j <= $missingstars; $j++)
                                        <img src="{{ asset('/images/utility/star.png')}}" height="20" width="20" alt="error loading">
                                    @endfor
                                </td>
                            </tr>
                        </table>
                    @endif
                @endif
            @endif

		</div>
        @foreach($reviews as $review)  
            <ul>
                <table border="1">
                    <tr><td rowspan = "5" style="text-align:center;"><img src="{{ asset('/images/gallery/'.$review->pic)}}" height="200" width="200" class = "review-img"></td>    
                    <tr><td><p>User: {{$review->users_name}}</p></td></tr>
                    <tr style="text-align:center;">
						<td>
							@for($i = 1; $i <= $review->rating; $i++)
								<img src="{{ asset('/images/utility/starchecked.png')}}" height="20" width="20" alt="error loading">
							@endfor
							<?php  $missingstars = 5 - $review->rating;  ?>
							@for($j = 1; $j <= $missingstars; $j++)
								<img src="{{ asset('/images/utility/star.png')}}" height="20" width="20" alt="error loading">
							@endfor
						</td>
					</tr>
					<tr><td><p>Date: {{$review->created_at}}</p></td></tr> 
                    <tr><td><p>Event: {{$review->events_name}}</p></td></tr>  
                    <tr><td colspan="2"><textarea readonly class = "textarea-readable"> {{$review->reviewtext}} </textarea></td></tr>						
            </ul>
        @endforeach		
    </div>
@endsection