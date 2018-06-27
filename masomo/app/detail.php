<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
    
    public function question(){
        return $this->belongsTo('App\Question');
    }
    
}
