<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Event;
use Illuminate\Http\Request;
use DateTime;

class EventsController extends Controller
{
	public function index($type,$id)
	{
		$events = DB::table('events')->where('id', '=', $id)->get();
		$max_pax = DB::table('events')->where('id', '=', $id)->pluck('nr_pax');
		$current_pax = DB::table('users_events')->where('event_id', '=', $id)->get();
        return view('eventsdetail', ['events' => $events , 'current_pax' => $current_pax]);    
	}

	public function addEvent(Request $request)
	{
        if(isset($request->name) and isset($request->about) and isset($request->date)){
            
            if(DateTime::createFromFormat('Y-m-d\TH:i', ($request->date)) !== false){
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
            else{
                return redirect()->back()->with('alert', 'Fill the Date Properly!');
            } 
        }
        else
        {
            return redirect()->back()->with('alert', 'Fill the fields Properly!');
        }
    }
    
    public function bookNow(Request $request)
    {
		$user = Auth::user();
		if ($user) {
			for ($i = 1; $i <= $request->number_pax; $i++) {
				$event = Event::find($request->events_id);
				$user->events()->attach($request->events_id);
			}
			//return redirect("/services/{$request->type_type}/{$request->events_id}");
			return redirect("/home");
		}		
    }

    public function deleteEvent(Request $request)
    {
        DB::table('events')->delete($request->event_id);
        return redirect("/services/{$request->type_name}");
    }

    public function eventsAPI()
    {
        $now = new DateTime();
        $events = DB::table('events')
                ->select('id','events_type_type','name','price','nr_pax','about','date')
                ->where('date','>',$now)->get();

        return response()->json($events);
    }
}
