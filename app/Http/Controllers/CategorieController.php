<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Categorie::orderby('id', 'asc')->paginate(10);
      return view('backend.categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Categorie::create($request->validate([
          'name' => 'required',
        ],
          [
            'name.required' => 'Kateqoriya adını mütləq daxil etməlisiniz',
          ]
        ));
        return redirect(url('/admin/kateqoriyalar/create'))->with('status', 'Kateqoriya uğurlu şəkildə əlavə edildi');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        return view('backend.categories.edit')->with('categorie',$categorie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        $categorie->update($request->validate([
          'name' => 'required',
        ],
          [
            'name.required' => 'Kateqoriya adı boş ola bilməz',
          ]));
        return redirect(url('/admin/kateqoriyalar/'.$categorie->id.'/edit'))->with('status', 'Kateqoriya uğurlu şəkildə redaktə edildi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect(url('/admin/kateqoriyalar'))->with('status', 'Kateqoriya uğurlu şəkildə silindi');
    }
}
