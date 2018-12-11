<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

class EventsController extends Controller
{
	public function index($type,$id)
	{
		$events = DB::table('events')->where('id', '=', $id)->get(); //query para a view utilizar para listar os eventos desse tipo
    	return view('eventsdetail', ['events' => $events]); 
	}

	public function addEvent(Request $request)
	{
		$event = new Event;
		$type->type = $request ->type; 
		save($type);
		return redirect("/services");
	}
}
