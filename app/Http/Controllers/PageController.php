<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    public function edit() {
      $page = Page::where('id', 1)->first();
      return view('backend.pages.edit',compact('page'));
    }

    public function update(Request $request , Page $sehife) {
      $data = $request->validate([
        'description' => 'required',
      ]);

      $sehife->update($data);
      return redirect(url('/admin/sehifeler/aboutus'))->with('status', 'Haqqımızda səhifəsi uğurla yeniləndi');
    }
}
