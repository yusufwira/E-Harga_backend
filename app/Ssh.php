<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ssh extends Model
{
    protected $table = 'ssh';

    public function hspk()
    {
    	return $this->belongsToMany('App\Hspk');
    }
}
