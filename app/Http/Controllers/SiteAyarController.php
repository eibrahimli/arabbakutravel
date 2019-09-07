<?php

namespace App\Http\Controllers;

use App\SiteAyar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SiteAyarController extends Controller
{
    public function update(Request $request,SiteAyar $site) {
      $oldVideoP = $site->videoP;
      $oldMenuP = $site->menuP;
      $oldGSP = $site->gsP;
      $oldtursP = $site->tursP;
      $oldotelsP = $site->otelsP;
      $oldrestoransP = $site->restoransP;
      $oldtransfersP = $site->transfersP;
      $oldcontactP = $site->contactP;
      $oldAboutP = $site->aboutP;

      $data = $request->validate([
        'videoTitle' => 'required',
        'videoUrl' => 'required',
        'videoSubTitle' => 'required',
        'videoP' => 'sometimes|file|image|mimes:jpeg,jpg,png,gif,svg',
        'menuP' => 'sometimes|file|image|mimes:jpeg,jpg,png,gif,svg',
        'gsP' => 'sometimes|file|image|mimes:jpeg,jpg,png,gif,svg',
        'tursP' => 'sometimes|file|image|mimes:jpeg,jpg,png,gif,svg',
        'otelsP' => 'sometimes|file|image|mimes:jpeg,jpg,png,gif,svg',
        'transfersP' => 'sometimes|file|image|mimes:jpeg,jpg,png,gif,svg',
        'restoransP' => 'sometimes|file|image|mimes:jpeg,jpg,png,gif,svg',
        'contactP' => 'sometimes|file|image|mimes:jpeg,jpg,png,gif,svg',
        'aboutP' => 'sometimes|file|image|mimes:jpeg,jpg,png,gif,svg',
      ]);

      $site->update($data);

      if($request->has('videoP')) {
        //Storage::delete('public/'.$oldVideoP);
        $site->update([
          'videoP' => $request->videoP->store('uploads/site_ayars','public')
        ]);
        $image = Image::make(public_path('storage/'.$site->videoP))->resize(1500,1000);
        $image->save();
      }
      if($request->has('menuP')) {
        Storage::delete('public/'.$oldMenuP);
        $site->update([
          'menuP' => $request->menuP->store('uploads/site_ayars','public')
        ]);
        $image = Image::make(public_path('storage/'.$site->menuP))->resize(1600,622);
        $image->save();
      }
      if($request->has('gsP')) {
        Storage::delete('public/'.$oldGSP);
        $site->update([
          'gsP' => $request->gsP->store('uploads/site_ayars','public')
        ]);
        $image = Image::make(public_path('storage/'.$site->gsP))->resize(501,306);
        $image->save();
      }
      if($request->has('tursP')) {
        Storage::delete('public/'.$oldtursP);
        $site->update([
          'tursP' => $request->tursP->store('uploads/site_ayars','public')
        ]);
        $image = Image::make(public_path('storage/'.$site->tursP))->resize(1400,470);
        $image->save();
      }
      if($request->has('otelsP')) {
        Storage::delete('public/'.$oldotelsP);
        $site->update([
          'otelsP' => $request->otelsP->store('uploads/site_ayars','public')
        ]);
        $image = Image::make(public_path('storage/'.$site->otelsP))->resize(1400,470);
        $image->save();
      }
      if($request->has('transfersP')) {
        Storage::delete('public/'.$oldtransfersP);
        $site->update([
          'transfersP' => $request->transfersP->store('uploads/site_ayars','public')
        ]);
        $image = Image::make(public_path('storage/'.$site->transfersP))->resize(1400,470);
        $image->save();
      }
      if($request->has('restoransP')) {
        Storage::delete('public/'.$oldrestoransP);
        $site->update([
          'restoransP' => $request->restoransP->store('uploads/site_ayars','public')
        ]);
        $image = Image::make(public_path('storage/'.$site->restoransP))->resize(1400,470);
        $image->save();
      }
      if($request->has('contactP')) {
        Storage::delete('public/'.$oldcontactP);
        $site->update([
          'contactP' => $request->contactP->store('uploads/site_ayars','public')
        ]);
        $image = Image::make(public_path('storage/'.$site->contactP))->resize(1400,470);
        $image->save();
      }
      if($request->has('aboutP')) {
        Storage::delete('public/'.$oldAboutP);
        $site->update([
          'aboutP' => $request->aboutP->store('uploads/site_ayars','public')
        ]);
        $image = Image::make(public_path('storage/'.$site->aboutP))->resize(1400,470);
        $image->save();
      }

      return redirect(url('/admin/index'))->with('status', 'Sayt index ayarları uğurlu şəkildə yeniləndi');
    }
}
