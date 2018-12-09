<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReviewsController extends Controller
{
    public function index()
    {
		$reviews = DB::table('reviews')->get(); // query para a view usar
		$events = DB::table('events')->get();
        return view('reviews', ['reviews' => $reviews , 'events' => $events ]);
    }
}
