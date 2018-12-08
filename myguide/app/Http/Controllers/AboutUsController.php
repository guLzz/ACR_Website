<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('aboutus');
    }
}
