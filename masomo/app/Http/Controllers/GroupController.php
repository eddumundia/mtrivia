<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GroupController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    function show(){
        $groups = new \App\Group();
        $ranks = $groups->getRanking();
        
        return view("group.view", compact('ranks'));
    }
    
    function join($id){
       /*
        * check id the user is in a group
        */
       $group = \App\Groupcontrol::where(['subject_id' => $id,'section_id'=> \Auth::user()->section_id, 'user_id' => \Auth::user()->id])->first();
       //$result = \App\Result::where(['subject_id' => $id, 'user_id' => \Auth::user()->id, ['group_id', '<>', NULL]])->first();
       if(empty($group)){
           return redirect("/group/joingroup/$id");
       }
       
        \Session::flash('danger','Sorry, you are already in the group, come back later after reset to join');
   
       return redirect('/group/show');
    }
    
    
function joingroup($id){
    $data = \App\Groupcontrol::where(['subject_id' => $id,'section_id'=> \Auth::user()->section_id, 'user_id' => \Auth::user()->id])->first();
      
    if(empty($data)){
        $hardest =  \App\Group::where(['subject_id' => $id,'section_id'=> \Auth::user()->section_id])->first();
        if(empty($hardest)){
            $group = new \App\Group();
            $group->section_id = \Auth::user()->section_id;
            $group->subject_id = $id;
            $group->save();
            $groupids = $group->id;
        }else{
            $groupids = $hardest->id;
        }

        $controls = new \App\Groupcontrol();
        $controls->user_id = \Auth::user()->id;
        $controls->section_id = \Auth::user()->section_id;
        $controls->subject_id = $id;
        $controls->group_id = $groupids;
        $controls->active = 1;
        $controls->save();
    /*
     * Get the hardest questions
     */
    
        $questions = \App\detail::latest()->where(["subject_id" => $id,'section_id' => \Auth::user()->section_id])->get();
        $idscount = $questions->random(50);

        $randoms = [];
        foreach ($idscount as $value) {
            $randoms[] = $value->question_id;
        }
    /*
     * 
     */
        $random = new \App\Random();
        $random->group_id =  $controls->group_id;
        $random->random_questions = serialize($randoms);
        $random->save();
    /*
     * 
     */
        $update = \App\Group::find($controls->group_id);
        $update->random_id = $random->id;
        $update->save();
    /*
     * 
     */
        $questionsrand = \App\Random::find($random->id);
        $arrays = $questionsrand->random_questions;
        $unserialize = unserialize($arrays);

        foreach ($unserialize as $value) {
           $details = \App\detail::find($value);
           if(!empty($details)){
               $details->randomized = ($details->randomized + 1);//count number of times it has been randomized
               $details->save();
           }
           $trivia = new \App\Trivia();
           $trivia->question_id = $value;
           $trivia->random_id = $random->id;
           $trivia->user_id = \Auth::user()->id;
           $trivia->save();
        }
    
        $start = \App\Trivia::where(['random_id' => $random->id, 'user_id' => \Auth::user()->id])->first()->question_id;

        $question = \App\Question::find($start);
        \Session::flash('success','The questions have been randomized, you are allowed to answer 50 questions, select the answer and the system will proceed to the next question');
   
        return view("group.groupquiz", compact('question'))->with('random_id', $random->id);
    }else{
        \Session::flash('danger','Sorry, you are already in the group, come back later after reset to join');
   
       return redirect('/group/show');
    }
    
}

public function proceedgroup($id, $answer, $fk_random){
    $trivia = \App\Trivia::where(['question_id' => $id, 'user_id' => \Auth::user()->id, 'random_id' => $fk_random])->first();
    //find the question in trivia
    $selected = \App\Answer::find($answer);
    //update with answers details.
    $trivia->answer = $selected->id;
    $trivia->correct = $selected->correct;
    $trivia->update();
    //go to the next question
    $questions = \App\Random::find($fk_random);
    $unserialize = unserialize($questions->random_questions);
    
    $current_question = \App\Question::find($id);
    
    $current = $id;
    $nextkey = array_search($current, $unserialize) + 1;
    if($nextkey == count($unserialize)) {
        $score = (\App\Trivia::where(['user_id' => \Auth::user()->id, 'random_id' => $fk_random, 'correct' => 1])->count()/50)*100;
        /*if($score < 30){
            $perfomance = "Fail";
        }else if($score > 30 && $score < 50){
            $perfomance = "Average";
        }else if($score > 50 && $score < 75){
            $perfomance = "Above average";
        }else if($score > 75 && $score < 85){
            $perfomance = "Excellent";
        }else if($score > 85){
            $perfomance = "Genius";
        }*/
        
        if(!empty($questions->group_id)){
            $groupdetails = \App\Group::find($questions->group_id);
            $groupdetails_subject_id = $groupdetails->subject_id;
            $groupdetails_section_id = $groupdetails->section_id;
        }else{
            $groupdetails_subject_id = $current_question->subject_id;
            $groupdetails_section_id = $current_question->section_id;
        }
        
        $result = new \App\Result();
        
        $updateresult = $result->updateResult($questions->group_id, "dummy", $score);
        /*$result->user_id = \Auth::user()->id;
        $result->fk_random = $fk_random;
        $result->trivia_result = $score;
        $result->perfomance = $perfomance;
        $result->group_id = $questions->group_id;
        $result->subject_id = $groupdetails_subject_id;
        $result->section_id = $groupdetails_section_id;
        $result->save();*/
        return redirect("group/show");
    }

    $next = $unserialize[$nextkey];
    
    $question = \App\Question::find($next);
    \Session::flash('success','The questions have been randomized, you are allowed to answer 50 questions, select the answer and the system will proceed to the next question');
    return redirect("/group/".$next."/nextquiz/".$fk_random);
}

public function nextquiz($id, $fk_random){
   $question = \App\Question::find($id);
   
   return view("group.groupquiz", compact('question'))->with('random_id', $fk_random);
}

public function revise($id){
   $trivia = \App\Trivia::where(['random_id' => $id, 'user_id' => \Auth::user()->id])->first();
    $name = \App\Answer::find($trivia->answer)->answer;
    $question = \App\Question::find($trivia->question_id);
    return view("group.revise", compact('question', 'trivia', 'name'))->with('random_id', $id); 
}


public function nextrevise($id, $random_id){
    $questions = \App\Random::find($random_id)->random_questions;
    $unserialize = unserialize($questions);
    
    $current = $id;
    $nextkey = array_search($current, $unserialize) + 1;
    if($nextkey == count($unserialize)) {
        return redirect("group/show");
    }
    
    $trivia = \App\Trivia::where(['random_id' => $random_id, 'question_id' => $unserialize[$nextkey], 'user_id' => \Auth::user()->id])->first();
   
    $name = \App\Answer::find($trivia->answer)->answer;
    $question = \App\Question::find($unserialize[$nextkey]);
    
    return view("group.revise", compact('question', 'trivia', 'name'))->with('random_id', $random_id);
}

function prevrevise($id, $random_id){
    $questions = \App\Random::find($random_id)->random_questions;
    $unserialize = unserialize($questions);
    
    $current = $id;
    $nextkey = array_search($current, $unserialize) - 1;
    if($nextkey == -1) {
        return redirect("question/$random_id/revise");
    }
    
    $trivia = \App\Trivia::where(['random_id' => $random_id, 'question_id' => $unserialize[$nextkey], 'user_id' => \Auth::user()->id])->first();
   
    $name = \App\Answer::find($trivia->answer)->answer;
    $question = \App\Question::find($unserialize[$nextkey]);
    return view("questions.revise", compact('question', 'trivia', 'name'))->with('random_id', $random_id);
}


}
