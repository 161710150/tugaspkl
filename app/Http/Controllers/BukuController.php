<?php

namespace App\Http\Controllers;

use App\Buku;
use Illuminate\Http\Request;
use App\JenisBuku;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function json()
    {
        $buku = Buku::all();
        return Datatables::of($buku)
        ->addColumn('jenisBuku', function($buku){
            return $buku->jenisbuku->Jenis;
        })
        ->addColumn('action', function($buku){
            return '<a href="#" class="btn btn-xs btn-success edit" data-id="'.$buku->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$buku->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';

            })
        ->rawColumns(['action','jenisBuku'])->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = JenisBuku::all();
        $buku = Buku::all();
        return view('buku.index', compact('jenis','buku'));
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
            'id_jb' => 'required',
            'Judul' => 'required',
            'Pengarang' => 'required',
            'Isbn' => 'required',
            'Thnterbit' => 'required',
            'Penerbit' => 'required',
            'Tersedia' => 'required',
        ],[
            'id_jb.required' => 'suplier Tidak Boleh Kosong',
            'Judul.required' => 'Kategori tidak boleh Kosong',
            'Pengarang.required' => 'Nama Barang Harus Diisi',
            'Isbn.required' => 'Isbn Tidak Boleh Kosong',
            'Thnterbit.required' => 'Harga Harus Diisi',
            'Penerbit.required' => 'Penerbit Harus Diisi',
            'Tersedia.required' => 'Harus Diisi',
        ]);
        $data = new Buku;
        $data->id_jb = $request->id_jb;
        $data->Judul = $request->Judul;
        $data->Pengarang = $request->Pengarang;
        $data->Isbn = $request->Isbn;
        $data->Thnterbit = $request->Thnterbit;
        $data->Penerbit = $request->Penerbit;
        $data->Tersedia = $request->Tersedia;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return $buku;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_jb' => 'required',
            'Judul' => 'required',
            'Pengarang' => 'required',
            'Isbn' => 'required',
            'Thnterbit' => 'required',
            'Penerbit' => 'required',
            'Tersedia' => 'required',
        ],[
            'id_jb.required' => 'suplier Tidak Boleh Kosong',
            'Judul.required' => 'Kategori tidak boleh Kosong',
            'Pengarang.required' => 'Nama Barang Harus Diisi',
            'Isbn.required' => 'Isbn Tidak Boleh Kosong',
            'Thnterbit.required' => 'Harga Harus Diisi',
            'Penerbit.required' => 'Penerbit Harus Diisi',
            'Tersedia.required' => 'Harus Diisi',
        ]);
        $data = Buku::findOrFail($id);
        $data->id_jb = $request->id_jb;
        $data->Judul = $request->Judul;
        $data->Pengarang = $request->Pengarang;
        $data->Isbn = $request->Isbn;
        $data->Thnterbit = $request->Thnterbit;
        $data->Penerbit = $request->Penerbit;
        $data->Tersedia = $request->Tersedia;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        //
    }
    public function removedatabuku(Request $request)
    {
        $bukudelete = Buku::find($request->input('id'));
        if($bukudelete->delete());
    }
}
