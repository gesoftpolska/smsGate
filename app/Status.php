<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function smses(){
        return $this->hasMany(Sms::class);
    }
}
