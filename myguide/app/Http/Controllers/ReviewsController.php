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
		    $reviews = DB::table('reviews')->get(); 
			$query1 = DB::table('users_events')->select('event_id')->where('user_id','=',$user)->distinct()->get();
			$query2 = DB::table('reviews')->select('events_id')->where('users_id','=',$user)->get();
			$needreview = ($query1->diffKeys($query2))->all();
			$needreview = json_decode(json_encode($needreview),true);

			if(count($needreview)){
                $events = array();
				foreach ($needreview as $key => $value) {
					$query = DB::table('events')->select('id','name')
						->where('id','=', $value['event_id'])
						->where('date', '<', $now)
						->get();
					if (count($query)) {
						array_push($events, ...$query);
					}
					
				}
				
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

    public function addReview(Request $request)
	{
		$eventName = DB::table('events')->select('name')->where('id','=', $request->events_id)->value('name'); 
		$user = Auth::user();
        $review = new Review;
        $review->events_id = $request->events_id;
        $review->events_name = $eventName; 
        $review->users_id = $user->id;
        $review->users_name = $user->name; 
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
