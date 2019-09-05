<?php

namespace App\Http\Controllers;

use App\Tur;
use App\Otel;
use App\User;
use App\Setting;
use App\Restoran;
use App\Transfer;
use App\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SiteController extends Controller
{
    public function index() {
      $categories = Categorie::all();
      $turs = Tur::orderby('id', 'desc')->take(6)->get();
      $otels = Otel::orderby('id', 'desc')->take(6)->get();
      return view('frontend.index',compact('categories','turs', 'otels'));
    }

    public function turIndex() {
      $turs = Tur::orderby('id', 'desc')->paginate(10);
      $categories = Categorie::all();
      return view('frontend.turlar.index',compact('turs','categories'));
    }

    public function showTur(Tur $tur,$slug) {
      return view('frontend.turlar.showTur', compact('tur'));
    }

    public function otelIndex() {
      $otels = Otel::orderby('id', 'desc')->paginate(10);
      return view('frontend.oteller.index', compact('otels'));
    }

    public function showOtel(Otel $otel,$slug) {
      $galeries = DB::table('galleries')->where('otel_id','=', $otel->id)->get();
      return view('frontend.oteller.showOtel', compact('otel','galeries'));
    }

    public function transferIndex() {
      $transfers = Transfer::orderby('id', 'desc')->paginate(10);
      return view('frontend.transferler.index', compact('transfers'));
    }

    public function showTransfer(Transfer $transfer,$slug) {

      return view('frontend.transferler.showTransfer', compact('transfer'));
    }

    public function restoranIndex() {
      $restorans = Restoran::orderby('id', 'desc')->paginate(10);
      return view('frontend.restoranlar.index', compact('restorans'));
    }

    public function showRestoran(Restoran $restoran,$slug) {

      return view('frontend.restoranlar.showRestoran', compact('restoran'));
    }

    public function showAboutus() {
      $about = DB::table('pages')->where('id', '=', '1')->first();

      return view('frontend.aboutus', compact('about'));
    }

    public function getUser(User $user) {
      
      return view('frontend.user.index', compact('user'));
    }

    public function changeP(Request $request, User $user) {

      $data = $request->validate([
        'password' => 'required|confirmed|min:8',
      ]);

      $data['password'] = Hash::make($data['password']);

      $user->update($data);

      return redirect(url('/profile/'.Auth::user()->id))->with('statusp', 'Şifrəniz uğurla dəyişdirildi');
    }

    public function changeEmail(Request $request, User $user) {
      $data = $request->validate([
        'email' => 'required|email|confirmed',
      ]);

      $user->update($data);

      return redirect(url('/profile/'.Auth::user()->id))->with('statusm', 'E-poçtunuz uğurla dəyişdirildi');
    }


    public function updateProfile(Request $request, User $user) {

      $oldImage = $user->photo;
      $data = $request->validate([
        'fName' => 'required|string',
        'lName' => 'required|string',
        'phone' => 'required|numeric',
        'street' => 'required',
        'city' => 'required',
        'country' => 'required',
        'photo' => 'sometimes|image|mimes:jpg,png,jpeg,svg,gif',
      ]);

      $user->update($data);

      if($request->has('photo')) {
        Storage::delete('public/' . $oldImage);
        $user->update([
          'photo' => request()->photo->store('uploads/users', 'public'),
        ]);
        $image = Image::make(public_path('storage/' . $user->photo))->resize(250, 250);
        $image->save();
      }

      return redirect(url('/profile/'.$user->id))->with('statusProfile', __('frontend.userUpdate'))->with('ok',true);
    }

    public function getKateqoriya(Categorie $kateqoriya, Request $request) {
      $turs = Tur::orderby('id')->where('turKat',$kateqoriya->id)->paginate(10);
      $categories = Categorie::all();
      return view('frontend.turlar.index', compact('turs', 'categories'));
    }

    public function create(Request $request) {
      $data = $request->validate([
        'fName' => 'required',
        'lName' => 'required',
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'message' => 'required',
        'context' => 'required'
      ]);

      $setting = Setting::first();
      $header = "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html; charset = utf-8\r\n";
      $header .= "From: ".$data['fName']." ".$data['lName']."<".$data['email'].">";
      $header .= "Reply-To: ".$data['fName']." ".$data['lName']. "<".$data['email'].">";
      $mesaj = '<div style="padding: 10px; font-size: 14px; color: #fff; font-weight:bold;">'.$data['context'].'</div>
                  <div style="margin: 10px 0; border: 1px solid #ddd;color: #333;padding: 10px;">'.$data['message'].'</div>
                  <div style="border-top: 1px solid #ddd; padding: 10px 0; font-style: oblique; color: #aaa;">Bütün Hüquqları Qorunur..</div>  
                ';
      if(mail($setting->siteMail, $data['context'], $mesaj,$header)) {
        return redirect(url('/contact'))->with('status', 'Mesajınız göndərildi');
      } else return redirect(url('/contact'))->with('status', 'Mesajınız göndərilmədi');

    }
}
