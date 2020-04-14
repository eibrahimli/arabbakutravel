<?php

namespace App\Http\Controllers;

use App\Dreamtour;
use Illuminate\Http\Request;

class DreamtourController extends Controller
{
    public function activedreamtours() {
        $turs = Dreamtour::orderby('id','desc')->where('status','1')->paginate(10);
        return view('backend.dreamtour.activeindex',compact('turs'));
    }

    public function deactivedreamtours() {
        $turs = Dreamtour::orderby('id','desc')->where('status','0')->paginate(10);
        return view('backend.dreamtour.deactiveindex',compact('turs'));
    }

    public function show (Dreamtour $dreamtur) {        
        return view('backend.dreamtour.show')->with('tur',$dreamtur);
    }

    public function active(Dreamtour $dreamtur) {
        $dreamtur->update(['status' => '1']);
        return back()->with('status','Dreamtur təsdiqli dreamturlara əlavə edildi..');
    }

    public function delete(Dreamtour $dreamtur) {
        $dreamtur->delete($dreamtur);
        return back()->with('status','Dreamtur silindi..');
    }

    public function update(Dreamtour $dreamtur,Request $request) {
        $request->validate([
            'title' => ['required'],
            'city' => ['required','min:3'],
            'desc' => ['required'],
            'schedule' => ['required'],
            'price' => ['required','numeric'],            
        ]);

        $dreamtur->update($request->all());
                
        return back()->with('status','Tur yeniləndi');
    }
}
