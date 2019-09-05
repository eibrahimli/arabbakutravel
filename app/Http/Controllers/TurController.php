<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Tur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turs = Tur::orderby('id','desc')->paginate(15);

        return view('backend.turs.index')->with('turs',$turs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        $tur = new Tur();
        return view('backend.turs.create', compact('categories','tur'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $this->validateData($request);

      $tur = Tur::create($data);

      if($request->has('turP') && $request->has('turSingleP')) {
        $tur->update([
          'turP' => $request->turP->store('uploads/turs','public'),
          'turSingleP' => $request->turSingleP->store('uploads/turs','public')
        ]);

        $image = Image::make(public_path('storage/'.$tur->turP))->resize(800,533);
        $image->save();
        $image = Image::make(public_path('storage/'.$tur->turSingleP))->resize(1400,470);
        $image->save();
      }
      return redirect(url('/admin/turlar/create'))->with('status', 'Tur uğurlu şəkildə əlavə edildi');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tur  $otel
     * @return \Illuminate\Http\Response
     */
    public function edit(Tur $tur)
    {
        $categories = Categorie::all();
        return view('backend.turs.edit')->with('tur',$tur)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tur  $otel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tur $tur)
    {
      $oldTurP = $tur->turP;
      $oldTurSingleP = $tur->turSingleP;

      $data = $request->validate([
        'turBas' => 'required',
        'turKat' => 'required',
        'turQiy' => 'required|numeric',
        'turAciq' => 'required',
        'turCedvel' => 'required',
        'turP' => 'sometimes|file|image|max:10000',
        'turSingleP' => 'sometimes|file|image|max:10000'
      ],
        [
        'turBas.required' => 'Tur başlığı boş ola bilməz!',
        'turQiy.required' => 'Turun qiyməti boş ola bilməz!',
        'turQiy.numeric' => 'Turun qiyməti ancaq rəqəmdən ibrarət olmalıdır boşuğa icazə verilmir!',
        'turAciq.required' => 'Tur post səhifəsinin açıqlaması boş ola bilməz!',
        'turCedvel.required' => 'Turun ediləcəklər cədvəli boş ola bilməz!',
        'turP.file' => 'Yüklədiyiniz fayl olmalıdır!',
        'turSingleP.file' => 'Yüklədiyiniz fayl olmalıdır!',
        'turP.image' => 'Yüklədiyiniz şəkil olmalıdır!',
        'turSingleP.image' => 'Yüklədiyiniz şəkil olmalıdır!',
        'turP.max' => 'Yüklədiyiniz şəkil 10 mb az olmalıdır!',
        'turSingleP' => 'Yüklədiyiniz şəkil 10 mb az olmalıdır!'
      ]);
      $tur->update($data);
      if($request->has('turP')) {
        Storage::delete('public/'.$oldTurP);
        $tur->update([
          'turP' => $request->turP->store('uploads/turs', 'public')
        ]);
        $image = Image::make(public_path('storage/'.$tur->turP))->resize(800,533);
        $image->save();
      }
      if($request->has('turSingleP')) {
        Storage::delete('public/'.$oldTurSingleP);
        $tur->update([
          'turSingleP' => $request->turSingleP->store('uploads/turs', 'public')
        ]);
        $image = Image::make(public_path('storage/'.$tur->turSingleP))->resize(1400,470);
        $image->save();
      }
      return redirect(url('/admin/turlar/'.$tur->id.'/edit'))->with('status', 'Tur uğurlu şəkildə yeniləndi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tur  $otel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tur $tur)
    {
        Storage::delete([
          'public/'.$tur->turP,
          'public/'.$tur->turSingleP,
        ]);

        $tur->delete();

        return redirect(url('/admin/turlar'))->with('status', 'Tur uğurlu bir şəkildə silindi');
    }

  public function validateData($request) {
    return $request->validate([
      'turBas' => 'required',
      'turKat' => 'required',
      'turQiy' => 'required|numeric',
      'turAciq' => 'required',
      'turCedvel' => 'required',
      'turP' => 'required|file|image|max:10000',
      'turSingleP' => 'required|file|image|max:10000'
    ],[
      'turBas.required' => 'Tur başlığı boş ola bilməz!',
      'turQiy.required' => 'Turun qiyməti boş ola bilməz!',
      'turQiy.numeric' => 'Turun qiyməti ancaq rəqəmdən ibrarət olmalıdır boşuğa icazə verilmir!',
      'turAciq.required' => 'Tur post səhifəsinin açıqlaması boş ola bilməz!',
      'turCedvel.required' => 'Turun ediləcəklər cədvəli boş ola bilməz!',
      'turP.required' => 'Tur anasəhifə şəklini mütləq yükləməlisiniz!',
      'turSingleP.required' => 'Tur post şəklini mütləq yükləməlisiniz!',
      'turP.file' => 'Yüklədiyiniz fayl olmalıdır!',
      'turSingleP.file' => 'Yüklədiyiniz fayl olmalıdır!',
      'turP.image' => 'Yüklədiyiniz şəkil olmalıdır!',
      'turSingleP.image' => 'Yüklədiyiniz şəkil olmalıdır!',
      'turP.max' => 'Yüklədiyiniz şəkil 10 mb az olmalıdır!',
      'turSingleP' => 'Yüklədiyiniz şəkil 10 mb az olmalıdır!'
    ]);
  }
}
