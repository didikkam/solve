<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\MediaNewsRequest;
use App\Http\Resources\MediaNewsCollection;
use App\Http\Resources\MediaNewsResource;
use App\Models\Category;
use App\Models\MediaNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MediaNewsController.
 */
class MediaNewsController
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('backend.media_news.index');
   }

   public function list(Request $request)
   {
      $request = $request->all();
      if (isset($request['id'])) {
         $data = MediaNews::findOrFail($request['id']);
         if ($data) {
            $data = new MediaNewsResource($data);
            $message = 'Success';
         } else {
            $message = 'Failed';
            $data = null;
         }
      } else {
         $data = MediaNews::query();
         $data = $data->where('status', 'published');
         if (isset($request['category'])) {
            $data = $data->with('categories');
            $data = $data->whereHas('categories', function ($query) use ($request) {
               return $query->where('slug', $request['category']);
            });
         }
         if (isset($request['search'])) {
            $data = $data->where('title', 'LIKE', '%' . $request['search'] . '%');
         }
         if (isset($request['provider_id'])) {
            $data = $data->where('provider_id', $request['provider_id']);
         }
         $data = $data->orderBy('created_at', 'desc');
         $size = 5;
         if (isset($request['size'])) {
            $size = $request['size'];
         }
         $data = $data->paginate($size);
         return MediaNewsResource::collection($data);
      }

      return response([
         'message'   => $message,
         'data'      => $data
      ], Response::HTTP_OK);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $categories = Category::where('scope', 'news')->get();
      return view('backend.media_news.create')->with([
         'categories' => $categories
      ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(MediaNewsRequest $request)
   {
      $data = [
         'category_id' => $request->category_id,
         'title' => $request->title,
         'source_link' => $request->source_link,
         'description' => $request->description,
         'view_as' => ($request->view_as) ? $request->view_as : 'list',
         'status' => ($request->status) ? $request->status : 'draft',
      ];
      $user = Auth::user();
      if ($user->provider_id) {
         $data['provider_id'] = $user->provider_id;
      }
      if ($request->image) {
         $data['image'] = $request->file('image')->store('media_news', 'public');
      }
      $data['slug'] = Str::slug($request->title);
      if (isset($request->id)) {
         $item = MediaNews::findOrFail($request->id);
         $query = $item->update($data);
      } else {
         $query = MediaNews::create($data);
      }
      if ($query) {
         return redirect()->route('admin.media_news.index')->withFlashSuccess(__('Berita berhasil disimpan'));
      } else {
         return redirect()->route('admin.media_news.index')->withFlashDanger(__('Berita gagal ditambah'));
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
      $categories = Category::where('scope', 'news')->get();
      $data = MediaNews::with('categories');
      $user = Auth::user();
      if ($user->provider_id) {
         $data = $data->where('provider_id', $user->provider_id);
      }
      $data = $data->findOrFail($id);
      return view('backend.media_news.edit')->with([
         'data' => $data,
         'categories' => $categories
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
      $item = MediaNews::findOrFail($id);
      $item->delete();
      return redirect()->route('admin.media_news.index')->withFlashSuccess(__('Berita berhasil dihapus.'));
   }
}
