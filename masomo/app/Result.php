<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function subject(){
        return $this->belongsTo('App\Subject');
    }
    
    public function group(){
        return $this->belongsTo('App\Group');
    }
    
    function updateResult($group_id, $perfomance, $score){
        
        $subj = $this->getSubject($group_id);
        $data = Result::latest()->where(['section_id' =>\Auth::user()->section_id, 'user_id' =>\Auth::user()->id])->first();
        if(empty($data)){
            $result = new \App\Result();
            $result->user_id = \Auth::user()->id;
            $result->group_id = $group_id;
            $result->section_id = \Auth::user()->section_id;
            $result->subject_id = \App\Group::where(['id' => $group_id])->first()->subject_id;
           // $result->perfomance = $perfomance;
            $result->$subj = $score;
            $result->group_results = ($result->group_results + $score);
            $result->save();
        }else{
        
        $data->$subj = $score;
        $data->user_id = \Auth::user()->id;
       // $data->perfomance = $perfomance;
        $data->group_results = ($data->group_results + $score);
        $data->save();
        }
    }
    
    function getSubject($group_id){
        $group = \App\Group::where(['id' => $group_id])->first();
        return \App\Subject::find($group->subject_id)->subj_code;//get from a relation
    }
}
