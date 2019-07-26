<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    public function todo()
    {
    	return $this->hasMany('App\Todo');
    }
}
