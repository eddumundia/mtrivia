<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function detail(){
        return $this->hasOne(\App\Detail::class);
    }
}
