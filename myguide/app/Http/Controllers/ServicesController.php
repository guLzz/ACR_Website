<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event_Type;
use Auth;
use DB;
use App\Http\Controllers\HTML;
use DateTime;

class ServicesController extends Controller
{
    public function index()
    {
		$types = DB::table('events_type')->get(); // query para a view usar
        return view('services', ['types' => $types]); 
	}

	public function showEvents($type)
	{
        $now = new DateTime();
        $events_type_live = DB::table('events')
                    ->where('events_type_type', '=', $type)
                    ->where('date', '>', $now)
                    ->orderBy('date', 'ASC')
                    ->get();
        $type_id = DB::table('events_type')->where('type' ,'=', $type)->pluck('id')->first();
        $type_type = DB::table('events_type')->where('type' ,'=', $type)->pluck('type')->first();
        return view('events', ['events' => $events_type_live , 'type_id' => $type_id, 'type_type' => $type_type]); 
	}

	public function addType(Request $request)
	{
        if(isset($request->type)){
            $type = new Event_Type;
            $type->type = $request->type; 
            $file = $request->file('type_pic');
            $filename= time().'-'.$file->getClientOriginalName();
            $file = $file->move('../public/images/types',$filename);
            $type->pic = $filename;
            $type->save();
            return redirect("/services/");
        }
        else{
            return redirect()->back()->with('alert', 'Fill the Type Properly!');
        }
    }
    
    public function deleteType(Request $request)
    {
        DB::table('events_type')->delete($request->type_id);
        return redirect("/services/");
    }
		
}
