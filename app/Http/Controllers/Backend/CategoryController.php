<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('backend.category.index');
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('backend.category.create');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(CategoryRequest $request)
   {
      $data = [
         'name' => $request->name,
         'description' => $request->description,
         'scope' => $request->scope,
      ];
      $data['slug'] = Str::slug($request->name);
      if (isset($request->id)) {
         $item = Category::findOrFail($request->id);
         $query = $item->update($data);
      } else {
         $query = Category::create($data);
      }
      if ($query) {
         return redirect()->route('admin.category.index')->withFlashSuccess(__('Kategori berhasil disimpan'));
      } else {
         return redirect()->route('admin.category.index')->withFlashDanger(__('Kategori gagal ditambah'));
      }
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $data = Category::findOrFail($id);
      return view('backend.category.edit')->with([
         'data' => $data,
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $item = Category::findOrFail($id);
      $item->delete();
      return redirect()->route('admin.category.index')->withFlashSuccess(__('Kategori berhasil dihapus.'));
   }
}
