<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $data = Timesheet::with('client')->get();
      return view('backend.timesheet.index')->with([
         'data' => $data
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $clients = Client::get();
      return view('backend.timesheet.create')->with([
         'clients' => $clients
      ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $request->validate([
         'date' => 'required',
         'client_id' => 'required',
         'kode_pek' => 'required',
         'jenis_penugasan' => 'required',
         'tahun' => 'required',
         'kode_akun' => 'required',
         'akun' => 'required',
      ]);
      $data = [
         'date' => date('Y-m-d', strtotime($request->date)),
         'client_id' => $request->client_id,
         'kode_pek' => $request->kode_pek,
         'jenis_penugasan' => $request->jenis_penugasan,
         'tahun' => date('Y-m-d', strtotime($request->tahun)),
         'kode_akun' => $request->kode_akun,
         'akun' => $request->akun,
      ];
      if (isset($request->id)) {
         $item = Timesheet::findOrFail($request->id);
         $query = $item->update($data);
      } else {
         $query = Timesheet::create($data);
      }
      if ($query) {
         return redirect()->route('admin.timesheet.index')->withFlashSuccess(__('Timesheet berhasil disimpan'));
      } else {
         return redirect()->route('admin.timesheet.index')->withFlashDanger(__('Timesheet gagal ditambah'));
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
      //
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
      //
   }
}
