<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
   use SoftDeletes;
   protected $fillable = ['updated_by'];
   
   /**
    * 
    * @var array
    */
   protected $dates = ['deleted_at'];




   public function subject(){
       return $this->belongsTo(Subject::class);
   }
   /*
    * 
    */
    public function section(){
        return $this->belongsTo(Sections::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function random(){
        return $this->belongsTo(Random::class);
    }
    
    public function detail(){
        return $this->hasOne('App\Detail');
    }
    
    public function enteredQuestions(){
        return [
            'class4' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>4])->count(),
            'class5' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>5])->count(),
            'class6' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>6])->count(),
            'class7' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>7])->count(),
            'class8' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>8])->count(),
        ];
    }
    public function verifiedQuestions(){
        return [
            'vclass4' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>4, 'verified' => 1])->count(),
            'vclass5' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>5, 'verified' => 1])->count(),
            'vclass6' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>6, 'verified' => 1])->count(),
            'vclass7' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>7, 'verified' => 1])->count(),
            'vclass8' =>  Question::where(['user_id' => \Auth::user()->id, 'section_id' =>8, 'verified' => 1])->count(),
        ];
    }
    public function deletedQuestions(){
        return [
            'dclass4' =>  Question::withTrashed()->where(['user_id' => \Auth::user()->id, 'section_id' =>4])->count(),
            'dclass5' =>  Question::withTrashed()->where(['user_id' => \Auth::user()->id, 'section_id' =>5])->count(),
            'dclass6' =>  Question::withTrashed()->where(['user_id' => \Auth::user()->id, 'section_id' =>6])->count(),
            'dclass7' =>  Question::withTrashed()->where(['user_id' => \Auth::user()->id, 'section_id' =>7])->count(),
            'dclass8' =>  Question::withTrashed()->where(['user_id' => \Auth::user()->id, 'section_id' =>8])->count(),
        ];
    }
}
