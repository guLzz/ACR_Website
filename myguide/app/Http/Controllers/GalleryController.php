<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GalleryController extends Controller
{
    public function index()
    {
		$images = DB::table('reviews')->get(); // query para a view usar
        return view('gallery', ['images' => $images]);
    }
}
