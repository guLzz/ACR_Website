<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HTML;
use App\Gallery;
use DB;
use Auth;
use DateTime;

class GalleryController extends Controller
{
    public function index()
    {
		$now = new DateTime();
        $user = Auth::user();
        $reviews = DB::table('reviews')->get(); 
        $images = DB::table('gallery')->get();
        $types = DB::table('events_type')->select('type','id')->get();
        if ($user) {
            $events_user = DB::table('users_events')->where('user_id', '=', $user->id)->distinct()->pluck('event_id');
            if (count($events_user)) {
				$events = array();
				foreach ($events_user as $value) {
					$array = array();
					$query = DB::table('events')->select('id','name')
						->where('id','=', $value)
						->where('date', '<', $now)
						->get();
					if (count($query)) {
						array_push($events, ...$query);
					}	
				}
                if (count($events)) {
                    return view('gallery', ['images' => $images, 'types' => $types ,'reviews' => $reviews ,'events' => $events ]);
                }
                else
                    return view('gallery', ['images' => $images, 'types' => $types ,'reviews' => $reviews]);
            }
            else
                return view('gallery', ['images' => $images,'types' => $types , 'reviews' => $reviews]);
        }    
        else
            return view('gallery', ['images' => $images, 'types' => $types ,'reviews' => $reviews]);
    }


    public function filterPics(Request $request)
	{
        $user = Auth::user();
        $now = new DateTime();
        $types = DB::table('events_type')->select('type','id')->get();
        $eventsFilter = DB::table('events')->select('id')->where('events_type_id','=', $request->type_id)->pluck('id'); //ids dos eventos do tipo
        
        $images = array();
        foreach ($eventsFilter as $key => $value) { //para cada id de evento add as imagens desses evento no array images
            $auxquery = DB::table('gallery')->select('name')->where('events_id','=',$value)->get();
            if (count($auxquery)) {
                array_push($images, ...$auxquery);
            }	
        }

        if ($user) {
            $events_user = DB::table('users_events')->where('user_id', '=', $user->id)->distinct()->pluck('event_id');
            if (count($events_user)) {
				$events = array();
				foreach ($events_user as $value) {
					$query = DB::table('events')->select('id','name')
						->where('id','=', $value)
						->where('date', '<', $now)
						->get();
					if (count($query)) {
						array_push($events, ...$query);
					}	
				}
                if (count($events)) {
                    return view('galleryfilter', ['types' => $types , 'images' => $images,'events' => $events ]);
                }
                else
                    return view('galleryfilter', ['types' => $types, 'images' => $images]);
            }
            else
                return view('galleryfilter', ['types' => $types ,'images' => $images]);
        }    
        else
            return view('galleryfilter', ['types' => $types,'images' => $images]);
	}

    public function addPic(Request $request)
	{
        $gallery = new Gallery;
        if ($request->hasFile('type_pic')) {
            $file = $request->file('type_pic');
            $filename= time().'-'.$file->getClientOriginalName();
            $file = $file->move('../public/images/gallery',$filename);
            $gallery->name = $filename;
            $gallery->events_id = $request->events_id; 
            $gallery->save();
            return redirect("/gallery/");
        }
        else{
            $gallery->events_id = $request->events_id; 
            $gallery->save();
            return redirect("/gallery/");
        }
        
    }
    
    public function deletePic(Request $request)
    {
        DB::table('gallery')->delete($request->pic_id);
        return redirect("/gallery");
    }
}
