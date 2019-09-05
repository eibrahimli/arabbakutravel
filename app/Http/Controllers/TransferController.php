<?php

namespace App\Http\Controllers;

use App\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $transfers = Transfer::orderby('id','desc')->paginate(15);
      return view('backend.transfers.index',compact('transfers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $transfer = new Transfer();
      return view('backend.transfers.create')->with('transfer', $transfer);
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
        'pickUpAdress' => 'required',
        'dropOffAdress' => 'required',
        'price' => 'required|numeric',
        'photo' => 'required|file|image|mimes:jpg,jpeg,png,gif,svg',
        'singlePhoto' => 'required|file|image|mimes:jpg,jpeg,png,gif,svg'
      ]);

      $transfer = Transfer::create($data);

      if($request->has('photo') && $request->has('singlePhoto')) {
        $transfer->update([
          'photo' => $request->photo->store('uploads/transfers','public'),
          'singlePhoto' => $request->singlePhoto->store('uploads/transfers','public')
        ]);

        $image = Image::make(public_path('storage/'.$transfer->photo))->resize(800,533);
        $image->save();
        $image = Image::make(public_path('storage/'.$transfer->singlePhoto))->resize(1400,470);
        $image->save();
      }
      return redirect(url('/admin/transferler/create'))->with('status','Transfer uğurlu şəkildə əlavə edildi');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        return view('backend.transfers.edit')->with('transfer',$transfer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
      $oldPhoto = $transfer->photo;
      $oldSinglePhoto = $transfer->singlePhoto;

      $data = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'pickUpAdress' => 'required',
        'dropOffAdress' => 'required',
        'price' => 'required|numeric',
        'photo' => 'sometimes|file|image|mimes:jpg,jpeg,png,gif,svg',
        'singlePhoto' => 'sometimes|file|image|mimes:jpg,jpeg,png,gif,svg'
      ]);

      $transfer->update($data);

      if($request->has('photo')) {
        Storage::delete('public/'.$oldPhoto);
        $transfer->update([
          'photo' => $request->photo->store('uploads/transfers','public'),
        ]);

        $image = Image::make(public_path('storage/'.$transfer->photo))->resize(800,533);
        $image->save();
      }
      if($request->has('singlePhoto')):
        Storage::delete('public/'.$oldSinglePhoto);
        $transfer->update([
          'singlePhoto' => $request->singlePhoto->store('uploads/transfers','public')
        ]);
        $image = Image::make(public_path('storage/'.$transfer->singlePhoto))->resize(1400,470);
        $image->save();
      endif;
      return redirect(url('/admin/transferler/'.$transfer->id.'/edit'))->with('status','Transfer uğurlu şəkildə yeniləndi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        Storage::delete('public/'.$transfer->photo);
        Storage::delete('public/'.$transfer->singlePhoto);
        $transfer->delete();
        return redirect(url('/admin/transferler'))->with('status', 'Transfer uğurla silindi');
    }
}
