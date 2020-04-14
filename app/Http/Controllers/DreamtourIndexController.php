<?php

namespace App\Http\Controllers;
use App\Categorie;
use App\Dreamtour;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DreamtourIndexController extends Controller
{
    public function index() {
        
        $categories = Categorie::orderby('id','desc')->get();
        return view('frontend.dreamtour.index',compact('categories'));
    }

    public function create(Request $request) {
        $data = $request->validate([
            'title' => ['required','min:3','max:200'],
            'city' => ['required','min:2','max:200'],
            'desc' => ['required'],
            'schedule' => ['required'],
            'price' => ['required', 'integer'],              
        ]);

        $dreamtur = Dreamtour::create($data);

        return back()->with('status',trans('frontend.dreamTourAdded'));
    }
}
