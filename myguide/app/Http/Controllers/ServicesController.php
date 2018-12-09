<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
		$events = DB::table('events')->where('events_type_id', '=', $type)->get(); //query para a view utilizar para listar os eventos desse tipo
    	return view::make('events', ['events' => $events]); 
	}
		
}
