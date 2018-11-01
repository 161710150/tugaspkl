<?php

namespace App\Http\Controllers;

use App\Anggota;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function json()
    {
        $anggota = Anggota::all();
        return Datatables::of($anggota)
        ->addColumn('action', function($anggota){
            return '<a href="#" class="btn btn-xs btn-success edit" data-id="'.$anggota->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$anggota->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';

            })
        ->rawColumns(['action'])->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('anggota.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'Noagt' => 'required',
            'Namaagt' => 'required',
            'Alamat' => 'required',
            'Kota' => 'required',
            'Telp' => 'required',
        ],[
            'Noagt.required' => 'Tidak Boleh Kosong',
            'Namaagt.required' => 'Harus Diisi',
            'Alamat.required' => 'Harus Diisi',
            'Kota.required' => 'Tidak Boleh Kosong',
            'Telp.required' => 'Tidak Boleh Kosong',
        ]);
        $data = new Anggota;
        $data->Noagt = $request->Noagt;
        $data->Namaagt = $request->Namaagt;
        $data->Alamat = $request->Alamat;
        $data->Kota = $request->Kota;
        $data->Telp = $request->Telp;

        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return $anggota;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Noagt'=>'required',
            'Namaagt' => 'required',
            'Alamat' => 'required',
            'Kota' => 'required',
            'Telp' => 'required',
        ],[
            'Noagt.required' => 'Tidak Boleh Kosong',
            'Namaagt.required' => 'Harus Diisi',
            'Alamat.required' => 'Harus Diisi',
            'Kota.required' => 'Tidak Boleh Kosong',
            'Telp.required' => 'Tidak Boleh Kosong',
        ]);
        $anggotaupdate = Anggota::findOrFail($id);
        $anggotaupdate->Noagt = $request->Noagt;
        $anggotaupdate->Namaagt = $request->Namaagt;
        $anggotaupdate->Alamat = $request->Alamat;
        $anggotaupdate->Kota = $request->Kota;
        $anggotaupdate->Telp = $request->Telp;
        $anggotaupdate->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
        //
    }
    public function removedataanggota(Request $request)
    {
        $anggotadelete = Anggota::find($request->input('id'));
        if($anggotadelete->delete());
    }
}
