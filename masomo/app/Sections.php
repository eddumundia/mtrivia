<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    public function users(){
        return $this->hasOne(User::class);
    }
}
