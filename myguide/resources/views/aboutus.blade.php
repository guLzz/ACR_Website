@extends('layouts.app')

@section('content')
    <div>
		<div> <!--admin quer adicionar mais campos-->
			@if($user = Auth::user())
            	@if(Auth::user()->role == 'Admin')
					<input type="text"> <!--titulo-->
					<textarea id="text-box" style = "height:200px;width:500px;"> </textarea> <!--about-->
					<button onclick = "addInfo()"> Add Info </button>
					<hr>
					<br>
				@endif
			@endif
		</div>
		<div>
			<h1>Who are we</h1>
			<h2>escrever muita palha</h2>
			<br>
			<h1>How to reach us</h1>
			<h2>moradas e numeros de telefone</h2>
    </div>
	</div>
	
@endsection