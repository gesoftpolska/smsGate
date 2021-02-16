<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table = 'smses';

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
