<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\SetReminder;

class Todo extends Model
{
    use SoftDeletes;
    
    protected $dispatchesEvents = [
        'created' => SetReminder::class,
    ];

    public function reminder()
    {
    	return $this->belongsTo('App\Reminder');
    }

}