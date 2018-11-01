<?php

namespace App\Http\Controllers;

use App\JenisBuku;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class JenisBukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function json()
    {
        $jenis = JenisBuku::all();
        return Datatables::of($jenis)
        ->addColumn('action', function($jenis){
            return '<a href="#" class="btn btn-xs btn-success edit" data-id="'.$jenis->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$jenis->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';

            })
        ->rawColumns(['action','jenis'])->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jenis.index');
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
            'Jenis' => 'required',
        ],[
            'Jenis.required' => 'Tidak Boleh Kosong',
        ]);
        $data = new JenisBuku;
        $data->Jenis = $request->Jenis;

        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JenisBuku  $jenisBuku
     * @return \Illuminate\Http\Response
     */
    public function show(JenisBuku $jenisBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisBuku  $jenisBuku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenisedit = JenisBuku::findOrFail($id);
        return $jenisedit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisBuku  $jenisBuku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Jenis'=>'required',
        ],[
            'Jenis.required' => 'Tidak Boleh Kosong',
        ]);
        $jenisbukuupdate = JenisBuku::findOrFail($id);
        $jenisbukuupdate->Jenis = $request->Jenis;
        $jenisbukuupdate->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisBuku  $jenisBuku
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisBuku $jenisBuku)
    {
        //
    }
    public function removedatajenisbuku(Request $request)
    {
        $jenisbukudelete = JenisBuku::find($request->input('id'));
        if($jenisbukudelete->delete());
    }
}
