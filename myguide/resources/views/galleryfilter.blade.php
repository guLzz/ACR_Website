@extends('layouts.app')

@section('content')

    <div>
        @if($user = Auth::user())
            @if(Auth::user()->role == 'User' || Auth::user()->role == 'Admin')
                @if(!empty($events))
                    <h1>Share your Experiences with the World!</h1>
                    <form action="/gallery/" method = "POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value ="{{csrf_token()}}">
                        <select name = "events_id" id="" required> <!--seleciona o evento pretendido para avaliar-->
                            <option value="" disabled selected> Choose Event </option>
							@foreach($events as $event)
								<option  value="{{$event->id}}"> {{$event->name}} </option>
                            @endforeach
                        </select>
                        <input type="file" name = "type_pic" onchange="uploadPic()">
                        <br><br>
                        <img src="" height="200" width="200" alt="Image preview">
                        <br><br>
                        <button type= "submit"> Upload </button>
                    </form>
                    <hr>
                @endif
            @endif
        @endif
    </div>
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
    <div>
        <h2>Filter: </h2>
        <form action="/gallery/filter/" method = "POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value ="{{csrf_token()}}">
            <select name = "type_id" id=""> 
                <option disabled selected> Choose a Type </option>
                @foreach($types as $type)
                    <option  value="{{$type->id}}"> {{$type->type}} </option>
                @endforeach
            </select>
            <button type= "submit"> Search </button>
        </form>
    </div>
    <div>
        @foreach($images as $image)
            <img src="{{ asset('/images/gallery/'.$image->name)}}" class="fancybox" height="200" width="200">
        @endforeach
    </div>

@endsection