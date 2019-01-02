<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>myguideMadeira</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('/css/mastyle.css')}}">
    </head>
    <body>
		<div>
			<video autoplay muted loop id="myVideo">
				<source src="{{ asset('/videos/mainvideo.mp4')}}" type="video/mp4">
			</video>
		</div>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
						
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div id = "main-link" class="title space">
                    <a href="{{ url('/home') }}">myguideMadeira</a>
                </div>
				
                <div class="links">
                    <a href="{{ url('/services') }}">Services</a>
                    <a href="{{ url('/reviews') }}">Reviews</a>
                    <a href="{{ url('/gallery') }}">Gallery</a>
                    <a href="{{ url('/aboutus') }}">About Us</a>
                </div>
            </div>
        </div>
    </body>
</html>
