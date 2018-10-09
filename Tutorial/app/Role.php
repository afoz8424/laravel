<?php

namespace Tutorial;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
    	return $this->belongsToMany('Tutorial\User');
    }
}
