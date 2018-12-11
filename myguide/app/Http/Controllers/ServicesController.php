<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Event_Type;
use Auth;
use DB;

class ServicesController extends Controller
{
    public function index()
    {
		$types = DB::table('events_type')->get(); // query para a view usar
		return view('services', ['types' => $types]);
	}

	public function showEvents($type)
	{
		$events = DB::table('events')->where('events_type_type', '=', $type)->get(); //query para a view utilizar para listar os eventos desse tipo
    	return view('events', ['events' => $events]); 
	}

	public function addType(Request $request)
	{
		$type = new Event_Type;
		$type->type = $request ->type; 
		$type->save();
		return redirect("/services");
	}
		
}
