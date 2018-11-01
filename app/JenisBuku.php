<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBuku extends Model
{
    protected $fillable = ['Jenis'];
    public $timestamp = true;

    public function buku(){
    	return $this->hasMany('App\Buku','id_jb');
    }
}
