<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Review;
use DateTime;

class ReviewsController extends Controller
{
    public function index()
    {	
		$now = new DateTime();
        $isUser = Auth::user();
        if (!$isUser) {
            $reviews = DB::table('reviews')->get();
            return view('reviews', ['reviews' => $reviews ]);
        }
        else
        {
            $user = Auth::user()->id;
		    $reviews = DB::table('reviews')->get(); 
            $events_user = DB::table('users_events')->where('user_id', '=', $user)->distinct()->pluck('event_id');
			//return $events_user;
			if (count($events_user)) {
				$events = array();
				foreach ($events_user as $value) {
					$query = DB::table('events')
						->where('id','=', $value)
						->where('date', '<', $now)
						->get();
					if (!$query) {
						array_push($events, $query);
					}
					
				}
				//return $events;
				
                if (count($events)) {
					return view('reviews', ['reviews' => $reviews , 'events' => $events ]); //ver porque apenas retorna 1, same with gallery
					//return $events;
                }
                else
                    return view('reviews', ['reviews' => $reviews ]);
            }
            else
                return view('reviews', ['reviews' => $reviews ]);
        }
    }

    public function addReview(Request $request)
	{
        $user = Auth::user();
        $review = new Review;
        $review->events_id = $request->events_id;
        $review->events_name = $request->events_name; 
        $review->users_id = $user->id;
        $review->users_name = $user->name; 
        $review->reviewtext = $request->textbox;   
        $file = $request->file('type_pic');
        $filename= time().'-'.$file->getClientOriginalName();
        $file = $file->move('../public/images/gallery',$filename);
        $review->pic = $filename;
		$review->save();
		return redirect("/reviews/");
	}
}
