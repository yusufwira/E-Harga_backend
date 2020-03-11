<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hspk extends Model
{
    protected $table = 'hspk';

    public function ssh()
    {
    	return $this->belongsToMany('App\Ssh');
    }
}
