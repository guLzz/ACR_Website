<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HTML;
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
			$reviews = DB::table('reviews')->orderBy('id', 'DESC')->get(); 
			$reviewRating = DB::table('reviews')->select('rating')->pluck('rating');
			$needreview = DB::table('users_events')->select('users_events.event_id')
						->join('reviews as reviews', 'reviews.events_id', '=', 'users_events.event_id', 'left outer')
						->where('reviews.events_id','=',null)
						->orderBy('users_events.event_id', 'ASC')
						->distinct()
						->pluck('event_id');
            $averageRating = 0;
			if(count($reviewRating)){
			    $sumRating = 0;
			    foreach ($reviewRating as $value) {
				    $sumRating = $sumRating + $value;
			    }

			    $averageRating = round($sumRating/count($reviewRating));
            }
			
			if(count($needreview)){
                $events = array();
				foreach ($needreview as $value) {
					$query = DB::table('events')->select('id','name')
						->where('id','=', $value)
						->where('date', '<', $now)
						->get();
					if (count($query)) {
						array_push($events, ...$query);
					}
					
				}
				//return $events;
				
                if (count($events)) {
					return view('reviews', ['reviews' => $reviews , 'averageRating' => $averageRating , 'events' => $events ]);
                }
                else
                    return view('reviews', ['reviews' => $reviews, 'averageRating' => $averageRating]);
            }
            else
                return view('reviews', ['reviews' => $reviews, 'averageRating' => $averageRating ]);
        }
    }

    public function addReview(Request $request)
	{
		$eventName = DB::table('events')->select('name')->where('id','=', $request->events_id)->value('name'); 
		$user = Auth::user();
        $review = new Review;
        $review->events_id = $request->events_id;
        $review->events_name = $eventName; 
        $review->users_id = $user->id;
		$review->users_name = $user->name; 
		$review->rating = $request->rating;
        $review->reviewtext = $request->textbox;   
        $file = $request->hasFile('type_pic');
        
        if($file){
            $file = $request->file('type_pic');
            $filename= time().'-'.$file->getClientOriginalName();
            $file = $file->move('../public/images/gallery',$filename);
            $review->pic = $filename;
        }
        else
            $review->pic = "noPic.png";
        
        $review->save();
		return redirect("/reviews/");
	}
}
