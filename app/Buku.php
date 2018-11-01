<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['id_jb','Judul','Pengarang','Isbn','Thnterbit','Penerbit','Tersedia'];
    public $timestamp = true;

    public function jenisbuku(){
    	return $this->belongsTo('App\JenisBuku','id_jb');
    }
    public function pinjam(){
    	return $this->hasMany('App\Pinjamkmbl','id_buku');
    }
}
