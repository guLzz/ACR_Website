@extends('layouts.app')

@section('content')
    <div>
        @if($user = Auth::user())
            @if(Auth::user()->role == 'User')
				@if(!empty($events))
					<h1>Share your Thoughts</h1>
					<select name="" id=""> <!--seleciona o evento pretendido para avaliar-->
						<option value=""selected="selected"> Choose Event </option>
						@foreach($events as $event)
							<option value="{{$event->name}}">{{$event->name}}</option>
						@endforeach
					</select>
					<button onclick = "uploadPic()" class = "my-button"> Upload </button>
					<textarea id="text-box" style = "height:200px;width:500px;"> </textarea>
					<button onclick = "addReview()" class = "my-button"> Review </button>
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
					<img src="../{{$review->pic}} " height="200" width="200" class = "review-img">
					<textarea readonly class = "textarea-readable"> {{$review->reviewtext}} </textarea>						
				</li>
			@endforeach
		</ul>		
    </div>
@endsection