<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class ReviewsController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
		$reviews = DB::table('reviews')->get(); 
        $events_user = DB::table('events_has_users')->where('users_id', '=', $user)->pluck('events_id');
        if (count($events_user)) {
            $events = DB::table('events')->where('id','=', $events_user)->get();
            if (count($events)) {
                return view('reviews', ['reviews' => $reviews , 'events' => $events ]);
            }
            else
                return view('reviews', ['reviews' => $reviews ]);
        }
        else
            return view('reviews', ['reviews' => $reviews ]);     
        
        
    }
}
