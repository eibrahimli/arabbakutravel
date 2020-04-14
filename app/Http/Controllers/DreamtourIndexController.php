<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DreamtourIndexController extends Controller
{
    public function index() {
        return view('frontend.dreamtour.index');
    }
}
