<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DateTime;
use DB;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $user = Auth::user();
        $now = new DateTime();

        $getUserEvents = DB::table('users_events')->select('event_id')
                        ->where('user_id','=', $user->id)->distinct()
                        ->pluck('event_id');

        $adminevents = DB::table('events')
                    ->where('date','>', $now)
                    ->get();
                        
        $oldevents = array();
        $newevents = array();
        foreach ($getUserEvents as $value) {
            $query = DB::table('events')
                    ->where('id','=', $value)
                    ->get();
            $querydate = DB::table('events')->select('date')
                        ->where('id','=', $value)
                        ->pluck('date');
            if ($querydate[0] > $now) {
                array_push($oldevents, ...$query);
            }
            else
            {
                array_push($newevents, ...$query);
            } 

        }

        return view('home', ['oldevents' => $oldevents, 'newevents' => $newevents, 'adminevents' => $adminevents]);
    }
}
