<?php

namespace App\Http\Controllers;

use App\Setting;
use App\SiteAyar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siteAyar = SiteAyar::where('id', 1)->first();
        return view('backend.index', compact('siteAyar'));
    }

    public function edit() {

      $ayarlar = Setting::where('id', 1)->first();
      $ayarlar->siteSocial = explode('|||',$ayarlar->siteSocial);
      
      return view("backend.settings.edit")->with('ayarlar',$ayarlar);
    }

    public function update(Request $request, Setting $setting) {
        $oldImage = $setting->siteLogo;

        $data = $request->validate([
          'siteFace' => 'required', 'siteInsta' => 'required', 'siteYoutube' => 'required',
          'siteTwitter' => 'required', 'siteGoogle' => 'required','siteTitle' => 'required',
          'siteDesc' => 'required', 'siteKey' => 'required', 'siteNum' => 'required',
          'siteMail' => 'required', 'siteFooterCopy' => 'required', 'siteAdress' => 'required',
          'siteLogo' => 'sometimes|file|image|max:5000',
        ],[
          'siteNum.required' => 'Saytın nömrəsi boş ola bilməz!',
          'siteTitle.required' => 'Saytın başlığı boş ola bilməz!',
          'siteDesc.required' => 'Saytın açıqlaması boş ola bilməz!',
          'siteKey.required' => 'Saytın açar sözləri boş ola bilməz!',
          'siteMail.required' => 'Saytın emaili boş ola bilməz!',
          'siteFace.required' => 'Saytın facebook adresi boş ola bilməz!',
          'siteInsta.required' => 'Saytın instagram adresi boş ola bilməz!',
          'siteTwitter.required' => 'Saytın twitter adresi boş ola bilməz!',
          'siteGoogle.required' => 'Saytın google adresi boş ola bilməz!',
          'siteYoutube.required' => 'Saytın youtube adresi boş ola bilməz!',
          'siteFooterCopy.required' => 'Saytın bütün hüquqları qorunur boş ola bilməz!',
          'siteAdress.required' => 'Adress boş ola bilməz!',
        ]);

      $data['siteSocial'] = $data['siteFace'].'|||' .$data['siteInsta'].'|||'.$data['siteTwitter'].'|||'.$data['siteGoogle'].'|||'.$data['siteYoutube'];

      for($i = 0; $i<5; $i++ ) array_shift($data);

      $setting->update($data);

      if($request->has('siteLogo')) {
        //Storage::delete('public/'.$oldImage);
        $setting->update([
          'siteLogo' => $request->siteLogo->store('uploads','public'),
        ]);
        $image = Image::make(public_path('storage/'.$setting->siteLogo))->fit(160,34);
        $image->save();
      }

      return redirect(url('/admin/settings'))->with('status', 'Ayarlar Yeniləndi...');
    }
}
;