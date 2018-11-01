<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjamkmbl extends Model
{
    protected $fillable = ['Nopjkb','id_agt','id_buku','Tglpjm','Tglharuskbl','Tglkbl','Denda'];
    public $timestamp = true;

    public function anggota(){
    	return $this->belongsTo('App\Anggota','id_agt');
    }

    public function bukupjkb(){
    	return $this->belongsTo('App\Buku','id_buku');
    }
}
