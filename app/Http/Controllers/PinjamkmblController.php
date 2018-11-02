<?php

namespace App\Http\Controllers;

use App\Pinjamkmbl;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use App\Anggota;
use App\Buku;
use Carbon\Carbon;

class PinjamkmblController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function json()
    {
        $pinjamkmbl = Pinjamkmbl::all();
        return Datatables::of($pinjamkmbl)
        ->addColumn('Anggota', function($pinjamkmbl){
            return $pinjamkmbl->anggota->Namaagt;
        })
        ->addColumn('Buku', function($pinjamkmbl){
            return $pinjamkmbl->bukupjkb->Judul;
        })
        ->addColumn('action', function($pinjamkmbl){
            return '<a href="#" class="btn btn-xs btn-success edit" data-id="'.$pinjamkmbl->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>';

            })
        ->rawColumns(['Anggota','Buku','action'])->make(true);
    }

    public function getdataedit($id)
    {
        $pinjam = Pinjamkmbl::find($id);
        $data['anggota']=$pinjam->anggota->Namaagt;
        $data['judulbuku']=$pinjam->bukupjkb->Judul;
        $data['tanggalpjm']=$pinjam->Tglpjm;
        $data['tanggalharuskbl']=$pinjam->Tglharuskbl;
        return json_encode($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjam = Pinjamkmbl::all();
        $anggota = Anggota::all();
        $buku = Buku::all();
        return view('pinjamkmbl.index', compact('pinjam','anggota','buku'));
    }
    public function index2()
    {
        $kbl = Pinjamkmbl::where('Tglkbl','=',null)->get();
        $anggotakbl = Anggota::all();
        $bukukbl = Buku::all();
        return view('pinjamkmbl.indexkedua', compact('kbl','anggotakbl','bukukbl'));
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
            'Nopjkb' => 'required',
            'id_agt' => 'required',
            'id_buku' => 'required',
            'Tglpjm' => 'required',
        ],[
            'Nopjkb.required' => 'suplier Tidak Boleh Kosong',
            'id_agt.required' => 'Kategori tidak boleh Kosong',
            'id_buku.required' => 'Nama Barang Harus Diisi',
            'Tglpjm.required' => 'Harga Harus Diisi',
        ]);
        $karbon = Carbon::now()->addDays(2)->toDateString();
        $tgl = '';
        $tgl .= date("y",strtotime($karbon)).'/';
        $tgl .= date("m",strtotime($karbon)).'/';
        $tgl .= date("d",strtotime($karbon));

        $data = new Pinjamkmbl;
        $data->Nopjkb = $request->Nopjkb;
        $data->id_agt = $request->id_agt;
        $data->id_buku = $request->id_buku;

        $data->Tglpjm = $request->Tglpjm;

        $data->Tglharuskbl = $tgl;
        $data->save();

        $sedia = Buku::where('id', $data->id_buku)->first();
        $sedia->Tersedia = $sedia->Tersedia - 1;
        $sedia->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pinjamkmbl  $pinjamkmbl
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjamkmbl $pinjamkmbl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pinjamkmbl  $pinjamkmbl
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = Pinjamkmbl::findOrFail($id);
        return $pinjam;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pinjamkmbl  $pinjamkmbl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updatekbl(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pinjamkmbl  $pinjamkmbl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjamkmbl $pinjamkmbl)
    {
        //
    }
}
