<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use DateTime;
use Auth;
use DB;

class BundleController extends Controller
{
    public function index()
    {   
        //$user = Auth::user()->id;
        $now = new DateTime();
        $types = DB::table('events_type')->select('id')->pluck('id');             
        $allevents = DB::table('events')->select('id')->pluck('id');
        $max_pax = DB::table('events')->select('nr_pax')->pluck('nr_pax');
        $max_pax = json_decode(json_encode($max_pax),true);
        //print_r($max_pax);
        //return;
        
        //return $max_pax;

        $current_pax = array();
        foreach ($allevents as $value) {
            $query = DB::table('users_events')
                        ->where('event_id','=',$value)
                        ->count();
            //return $query;
            if($query > -1) 
                array_push($current_pax, $query);
        }
        //return $current_pax;

        $events = array();
        foreach ($types as $value) {
            $query = DB::table('events')
                    ->where('events_type_id','=',$value)
                    ->where('date','>',$now)
                    ->get();
            if (count($query)) {
                array_push($events, $query);
            }	
        }
        //print_r($events);
        //return; 
        //return $events[0]; // 
        return view('bundle', ['events' => $events, 'current_pax' => $current_pax, 'max_pax' => $max_pax]);
    }

    public function newBundle(Request $request)
    {    
        $user = Auth::user();
        $checkboxes = $request->event_id;
        
        foreach($checkboxes as $checkbox)
        {
            if ($user) {
                $event = Event::find($checkbox);
                $user->events()->attach($checkbox);          
            }
        }
        
        
        //return redirect("/bundle/");
		return redirect("/home");
	}

}
