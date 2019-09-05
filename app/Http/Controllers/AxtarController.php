<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Otel;
use App\Restoran;
use App\Tur;
use Illuminate\Http\Request;

class AxtarController extends Controller
{
    public function turAxtar(Request $request) {
      $data = $request->validate([
        'turBas' => 'sometimes',
        'turKat' => 'sometimes',
      ]);

      if($data['turKat'] == 0) {
        $turs = Tur::where('turBas', 'LIKE', '%'.$data['turBas'].'%')->paginate(10);
      } elseif (empty($data['turBas'])) {
          $turs = Tur::where('turKat', $data['turKat'])->paginate(10);
      }
      else {
        $turs = Tur::where('turBas', 'LIKE', '%'.$data['turBas'].'%')->orWhere('turKat', '=',$data['turKat'])->paginate(10);
      }

      $categories = Categorie::all();

      return view('frontend.axtaris.turSearch')->with('turs',$turs)->with('categories',$categories);
    }

    public function otelAxtar(Request $request) {
      $data = $request->validate([
        'name' => 'sometimes',
        'district' => 'sometimes',
      ]);

      if (empty($data['name'])) {
        $otels = Otel::where('district', $data['district'])->paginate(10);
      }
      else {
        $otels = Otel::where('name', 'LIKE', '%'.$data['name'].'%')->orWhere('district', '=',$data['district'])->paginate(10);
      }

      return view('frontend.axtaris.otelSearch')->with('otels',$otels);
    }
    public function restoranAxtar(Request $request) {
      $data = $request->validate([
        'name' => 'sometimes',
        'district' => 'sometimes',
      ]);

      if (empty($data['name'])) {
        $restorans = Restoran::where('district', $data['district'])->paginate(10);
      }
      else {
        $restorans = Restoran::where('name', 'LIKE', '%'.$data['name'].'%')->orWhere('district', '=',$data['district'])->paginate(10);
      }

      if(count($restorans) == 0) {
        $message = 'Axtarışa uyğun saytda restoran tapılmadı';
        return view('frontend.axtaris.restoranSearch',compact('message'));
      }

      return view('frontend.axtaris.restoranSearch',compact('restorans'));
    }
}
