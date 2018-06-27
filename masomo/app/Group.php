<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function result(){
        return $this->hasOne('App\Result');
    }
  
    public function getsubjects(){
        return [
            'Kiswahili' => Group::where(['subject_id' =>1, 'section_id' => \Auth::user()->section_id ])->count(),
            'Mathematics' => Group::where(['subject_id' =>2, 'section_id' => \Auth::user()->section_id ])->count(),
            'English' => Group::where(['subject_id' =>3, 'section_id' => \Auth::user()->section_id ])->count(),
            'Social Studies and Religion' => Group::where(['subject_id' =>4, 'section_id' => \Auth::user()->section_id ])->count(),
            'Science' => Group::where(['subject_id' =>5, 'section_id' => \Auth::user()->section_id ])->count(),
        ];
    }
    
    public function getResults(){
        return [
            'Kiswahili' => Result::where(['subject_id' =>1, 'section_id' => \Auth::user()->section_id])->orderBy('trivia_result','desc')->get(),
            'Mathematics' => Result::where(['subject_id' =>2, 'section_id' => \Auth::user()->section_id])->orderBy('trivia_result','desc')->get(),
            'English' => Result::where(['subject_id' =>3, 'section_id' => \Auth::user()->section_id])->orderBy('trivia_result','desc')->get(),
            'Social Studies and Religion' => Result::where(['subject_id' =>4, 'section_id' => \Auth::user()->section_id])->orderBy('trivia_result','desc')->get(),
            'Science' => Result::where(['subject_id' =>5, 'section_id' => \Auth::user()->section_id])->orderBy('trivia_result','desc')->get(),
        ];
    }
    
    public function getRanking(){
        return Result::where(['section_id' => \Auth::user()->section_id])
            ->whereNotNull("group_results")
            ->orderBy('group_results','desc')
            ->get();     
    }
}
