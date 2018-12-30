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
                        </select><br>
                        <label for="text-box">No more than 150 characters</label><br>
                        <textarea id="text-box" style = "height:200px;width:500px;" name = "textbox" maxlength = "150"> </textarea>
                        <table>
                            <tr>
                                <td>
                                    <input type="file" name = "type_pic" onchange="uploadPic()">
                                </td>
                                <td>
                                    <img src="" height="200" width="200" alt="Image preview">
                                </td>
                            </tr>
                        </table>
                        <br>
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
                    <script>
                        $('textarea#text-box').on('keyup',function() 
                        {
                            var maxlen = $(this).attr('maxlength');
                            
                            var length = $(this).val().length;
                            if(length > (maxlen-10) ){
                                $('#text-box').text('max length '+maxlen+' characters only!')
                            }
                            else
                            {
                            $('#text-box').text('');
                            }
                        });
                    </script>
					<hr>
					<br>
				@endif	
            @endif
        @endif
    </div>
    <div>
        @foreach($reviews as $review)  
            <ul>
                <table>
                    <tr><td rowspan = "5" style="text-align:center;"><img src="{{ asset('/images/gallery/'.$review->pic)}}" height="200" width="200" class = "review-img"></td>    
                    <tr><td><p>User: {{$review->users_name}}</p></td></tr>
                    <tr><td><p>Date: {{$review->created_at}}</p></td></tr> 
                    <tr><td><p>Event: {{$review->events_name}}</p></td></tr>  
                    <tr><td><textarea readonly class = "textarea-readable"> {{$review->reviewtext}} </textarea></td></tr>						
            </ul>
        @endforeach		
    </div>
@endsection