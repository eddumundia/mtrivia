<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = array('subject_name');
    
    
    public function question(){
        return $this->hasOne("App\question");
    }
    
    public function subject_result(){
        return $this->belongsTo(Result::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    static function listSubjects(){
        return Subject::all()->pluck('id', 'subject_name');
    }
}
