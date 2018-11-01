<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = ['Noagt','Namaagt','Alamat','Kota','Telp'];
    public $timestamp = true;

    public function pinjamkbl(){
    	return $this->hasMany('App\Pinjamkbl','id_agt');
    }
}
