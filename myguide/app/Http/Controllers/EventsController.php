<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
	public function index($type,$id)
	{
		$events = DB::table('events')->where('id', '=', $id)->get(); //query para a view utilizar para listar os eventos desse tipo
    	return view('eventsdetail', ['events' => $events]); 
	}

		public function addEvent(Request $request,$type)
	{
        $url = $request->path();
        $event = new Event;
        $event->events_type_id = $request->type_id;; //id da wildcard
        $event->events_type_type = $request->type_type;; //wildcard
        $file = $request->file('type_pic');
        $filename= time().'-'.$file->getClientOriginalName();
        $file = $file->move('../public/images/events',$filename);
        $event->pic = $filename;
        $event->name = $request->name;
        $event->about = $request->about;
        $event->price = $request->price;
        $event->date = $request->date;
        $event->nr_pax = $request->nr_pax; 
        $event->save();
		return redirect("/services/{$request->type_type}"); 
	}
}
