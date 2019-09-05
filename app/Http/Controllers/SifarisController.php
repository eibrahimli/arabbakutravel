<?php

namespace App\Http\Controllers;

use App\Tur;
use App\TurSifaris;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SifarisController extends Controller
{
  public function __construct()
  {
    $this->middleware('onlyAdmin')->except('turCreate');
  }

  public function turIndex() {

    $sifarisler = TurSifaris::orderby('id', 'desc')->where('status',1)->get();
    return view('backend.bookings.turIndex',compact('sifarisler'));
  }

  public function turNotActiveIndex() {
    $sifarisler = TurSifaris::orderby('id', 'desc')->where('status',0)->get();

    return view('backend.bookings.turNotActiveIndex')->with('sifarisler', $sifarisler);
  }

  public function turSifarisActive(TurSifaris $sifaris) {
    $sifaris->update(['status' => 1]);
    return redirect(url('/admin/sifarisler/turdeaktivsifarisler'))->with('status', 'Sifariş aktiv edildi');
  }

  public function turSifarisSil(TurSifaris $sifaris) {
    $sifaris->delete($sifaris);

    return redirect(url('/admin/sifarisler/turaktivsifarisler'))->with('status', 'Sifariş uğurlu şəkildə silindi');
  }

  public function turCreate(Request $request,User $id) {

      $data = $request->validate([
        'adults' => 'required|numeric',
        'child' => 'sometimes|numeric',
        'tur_id' => 'required|numeric',
        'title' => 'required',
        'price' => 'required|numeric',
      ]);

      $data['price'] = $data['adults']*$data['price'];
      $data['customer'] = $id->fName.' '.$id->lName;
      $data['email'] = $id->email;
      $data['phone'] = $id->phone;
      $data['status'] = 0;
      $data['user_id'] = $id->id;

      TurSifaris::create($data);

      return redirect(url('/profile/'.$id->id))->with('turSifarisSatus', $data['title'].' başlıqlı tur sifariş edildi..');
    }
}
