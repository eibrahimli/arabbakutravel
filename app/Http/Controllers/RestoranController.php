<?php

namespace App\Http\Controllers;

use App\Restoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RestoranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $restorans = Restoran::orderby('id','desc')->paginate(15);
      return view('backend.restorans.index')->with('restorans',$restorans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $restoran = new Restoran();
      return view('backend.restorans.create', compact('restoran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'adress' => 'required',
        'district' => 'required',
        'price' => 'required|numeric',
        'photo' => 'required|file|image|mimes:jpg,jpeg,png,gif,svg',
        'singlePhoto' => 'required|file|image|mimes:jpg,jpeg,png,gif,svg'
      ]);

      $restoran = Restoran::create($data);

      if($request->has('photo') && $request->has('singlePhoto')) {
        $restoran->update([
          'photo' => $request->photo->store('uploads/restorans','public'),
          'singlePhoto' => $request->singlePhoto->store('uploads/restorans','public')
        ]);

        $image = Image::make(public_path('storage/'.$restoran->photo))->resize(800,533);
        $image->save();
        $image = Image::make(public_path('storage/'.$restoran->singlePhoto))->resize(1400,470);
        $image->save();
      }
      return redirect(url('/admin/restoranlar/create'))->with('status','Restoran uğurlu şəkildə əlavə edildi');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restoran  $restoran
     * @return \Illuminate\Http\Response
     */
    public function edit(Restoran $restoran)
    {
        return view('backend.restorans.edit', compact('restoran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restoran  $restoran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restoran $restoran)
    {
      $oldPhoto = $restoran->photo;
      $oldSinglePhoto = $restoran->singlePhoto;

      $data = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'district' => 'required',
        'adress' => 'required',
        'price' => 'required|numeric',
        'photo' => 'sometimes|file|image|mimes:jpg,jpeg,png,gif,svg',
        'singlePhoto' => 'sometimes|file|image|mimes:jpg,jpeg,png,gif,svg'
      ]);

      $restoran->update($data);

      if($request->has('photo')) {
        Storage::delete('public/'.$oldPhoto);
        $restoran->update([
          'photo' => $request->photo->store('uploads/restorans','public'),
        ]);

        $image = Image::make(public_path('storage/'.$restoran->photo))->resize(800,533);
        $image->save();
      }
      if($request->has('singlePhoto')):
        Storage::delete('public/'.$oldSinglePhoto);
        $restoran->update([
          'singlePhoto' => $request->singlePhoto->store('uploads/restorans','public')
        ]);
        $image = Image::make(public_path('storage/'.$restoran->singlePhoto))->resize(1400,470);
        $image->save();
      endif;
      return redirect(url('/admin/restoranlar/'.$restoran->id.'/edit'))->with('status','Restoran uğurlu şəkildə yeniləndi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restoran  $restoran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restoran $restoran)
    {
        //
    }
}
