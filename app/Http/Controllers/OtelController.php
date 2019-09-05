<?php

namespace App\Http\Controllers;

use App\Otel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OtelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $otels = Otel::orderby('id', 'desc')->paginate(15);
      return view('backend.otels.index', compact('otels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $otel = new Otel();

        return view('backend.otels.create', compact('otel'));
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
          'price' => 'required|numeric',
          'city' => 'required',
          'category' => 'required',
          'district' => 'required',
          'photo' => 'required|file|image|mimes:jpg,jpeg,png,gif,svg',
          'singlePhoto' => 'required|file|image|mimes:jpg,jpeg,png,gif,svg'
        ]);

      $otel = Otel::create($data);

      if($request->has('photo') && $request->has('singlePhoto')) {
        $otel->update([
          'photo' => $request->photo->store('uploads/otels','public'),
          'singlePhoto' => $request->singlePhoto->store('uploads/otels','public')
        ]);

        $image = Image::make(public_path('storage/'.$otel->photo))->resize(800,533);
        $image->save();
        $image = Image::make(public_path('storage/'.$otel->singlePhoto))->resize(1400,470);
        $image->save();
      }

        $request->validate([
            'galery' => 'required',
            'galery.*' => 'file|image|mimes:jpg,png,gif,svg,jpeg',
        ]);

        if($request->has('galery')):
          foreach ($request->galery as $image):
              //Get the file name with the extension
              $fileNameWithExt = $image->getClientOriginalName();
              //Get just file
              $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);

              //Get just extension
              $fileExt = $image->getClientOriginalExtension();

              //Filename to store
              $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;

              //Uplaod image
              $path = $image->storeAs('uploads/otels/gallery', $fileNameToStore, 'public');
              $image = Image::make(public_path('storage/'.$path))->resize(1000,667);
              $image->save();
              DB::insert('insert into galleries (name, otel_id) values (?, ?)', [$path, $otel->id]);
          endforeach;
        endif;

      return redirect(url('/admin/oteller/create'))->with('status', 'Otel uğurlu şəkildə əlavə edildi');

    }

    public function show(Otel $otel) {

      $galeries = DB::table('galleries')->where('otel_id', '=', $otel->id)->paginate(12);
      if(count($galeries) > 0)
        return view('backend.otels.galery',compact('otel','galeries'));
      else return redirect(url('/admin/oteller/'.$otel->id.'/edit'));
    }

    public function showDelete($id) {
      $galeries = DB::table('galleries')->where('id', '=', $id)->get();
      Storage::delete('public/'.$galeries[0]->name);
      DB::table('galleries')->where('id', '=', $id)->delete();
      return redirect(url('/admin/oteller/qaleriya/'.$galeries[0]->otel_id))->with('status', 'Şəkil uğurla silindi');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Otel  $otel
     * @return \Illuminate\Http\Response
     */
    public function edit(Otel $otel)
    {
        return view('backend.otels.edit')->with('otel',$otel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Otel  $otel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Otel $otel)
    {
      $oldPhoto = $otel->photo;
      $oldTurSinglePhoto = $otel->singlePhoto;

      $data = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'adress' => 'required',
        'price' => 'required|numeric',
        'city' => 'required',
        'category' => 'required',
        'district' => 'required',
        'photo' => 'sometimes|file|image|mimes:jpg,png,gif,svg,jpeg',
        'singlePhoto' => 'sometimes|file|image|mimes:jpg,png,gif,svg,jpeg'
      ]);

      $otel->update($data);

      if($request->has('photo')):
        Storage::delete('public/'.$oldPhoto);
        $otel->update([
          'photo' => $request->photo->store('uploads/otels','public'),
        ]);
        $image = Image::make(public_path('storage/'.$otel->photo))->resize(800,533);
        $image->save();
      endif;

      if($request->has('singlePhoto')):
        Storage::delete('public/'.$oldTurSinglePhoto);
        $otel->update([
          'singlePhoto' => $request->singlePhoto->store('uploads/otels','public')
        ]);

        $image = Image::make(public_path('storage/'.$otel->singlePhoto))->resize(1400,470);
        $image->save();
      endif;

      $request->validate([
        'galery' => 'sometimes',
        'galery.*' => 'file|image|mimes:jpg,png,gif,svg,jpeg',
      ]);

      if($request->has('galery')):
        foreach ($request->galery as $image):
          //Get the file name with the extension
          $fileNameWithExt = $image->getClientOriginalName();
          //Get just file
          $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);

          //Get just extension
          $fileExt = $image->getClientOriginalExtension();

          //Filename to store
          $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;

          //Uplaod image
          $path = $image->storeAs('uploads/otels/gallery', $fileNameToStore, 'public');
          $image = Image::make(public_path('storage/'.$path))->resize(1000,667);
          $image->save();
          DB::insert('insert into galleries (name, otel_id) values (?, ?)', [$path, $otel->id]);
        endforeach;
      endif;

      return redirect(url('/admin/oteller/'.$otel->id.'/edit'))->with('message', 'Otel uğurlu şəkildə yeniləndi');
    }

    public function destroy(Otel $otel)
    {
      $galeries = DB::table('galleries')->where('otel_id', '=', $otel->id)->get();

      foreach ($galeries as $galery) {
        Storage::delete('public/'.$galery->name);
      }
      DB::table('galleries')->where('otel_id', '=', $otel->id)->delete();
      Storage::delete('public/'.$otel->photo);
      Storage::delete('public/'.$otel->singlePhoto);
      $otel->delete();
      return redirect(url('/admin/oteller'))->with('status','Otel uğurlu şəkildə silindi');
    }
}
