<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Excel;
use App\Question;
use App\Topic;
use Input;

use Yajra\Datatables\Datatables;

class QuestionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        if(\Auth::user()->role_id == 3){
            $query = "user_id";
            $questions = Question::latest()->with('user')->where([$query => \Auth::user()->id])->get();
        }else if(\Auth::user()->role_id == 4){
            $query = "verified_by";
            $questions = Question::latest()->with('user')->where([$query => \Auth::user()->id])->get();
        }else if(\Auth::user()->role_id == 5){
            $questions = Question::latest()->get();
        }
       
        return view('questions.index', compact('questions'));
    }
    
    
    public function create(){
        return view('questions.create');
    }
    
    public function store(Request $Requests){
        $question = new question();
        $question->question = $Requests->input('question');
        $question->subject_id = \Auth::user()->subject_id;
        $question->section_id = \Auth::user()->section_id;
        $question->user_id = \Auth::user()->id;
        if($question->save()){
            $answers = array(
                new \App\Answer(array('user_id' => \Auth::user()->id, 'answer' => $Requests->input('firstoption'))),
                new \App\Answer(array('user_id' => \Auth::user()->id, 'answer' => $Requests->input('secondoption'))),
                new \App\Answer(array('user_id' => \Auth::user()->id, 'answer' => $Requests->input('thirdoption'))),
                new \App\Answer(array('user_id' => \Auth::user()->id, 'answer' => $Requests->input('fourthoption'))),
            );
            $questions = Question::find($question->id);
            $questions->answers()->saveMany($answers);
        }
        
        $auth = \Auth::user()->role_id;
        \Session::flash('success','The question and answers has been added successfully');
        if($auth == 3){
            return redirect("/question/create");
        }
        return redirect("/question");
 
    }
    // public function show(Question $question){
    public function show($id){
       $question = Question::findOrFail($id);
       $topics  = \App\Topic::where(['section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->get();
       return view("questions.view", compact('question', 'topics'))->with('qid', $id);
    }
    
    public function edit($id){
        $question = Question::findOrFail($id);
        $subjects = \App\Subject::all();
        $sections = \App\Sections::all();
        //$topics  = \App\Topic::where(['section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->get();
       // $details = \App\Detail::find(['question_id' =>$id]);
        return view("questions.edit", compact('question', 'subjects', 'sections'));
    }
    
public function update(Request $request, $id)
{
   $question = Question::find($id);
   $question->subject_id = $request->input('subject_id');
   $question->section_id = $request->input('section_id');
   $question->question = $request->input('question');
   $question->explanation = $request->input('explanation');
   $question->updated_by = \Auth::user()->id;
   if($question->save()){
       
       /*$details = \App\Details::find(['question_id' =>$id]);
       $details->explanation = $request->input('explanation');
       $details->topic = $request->input('topic');
       $details->subject_id = $request->input('subject_id');
       $details->section_id = $request->input('section_id');
       $details->save();
       $options = $request->all()['options'];
       $answers = $question->answers;
       
        
       foreach ($options as $answer) {
          $answer = \App\Answer::find(['answer' =>$answer]);
       }*/
   }
    return redirect("/question/$id");
}
 /*
  * 
  */
public function Saveexplanation(Request $request,$id){
    $answers  = \App\Answer::where(['question_id' => $id, 'correct' => 1])->first();
    if(!empty($answers)){
        $question = Question::find($id);
        $details = new \App\detail();
        $details->explanation = $request->input('explanation');
        $details->topic_id = $request->input('topic');
        $details->question_id = $id;
        $details->subject_id = $question->subject_id;
        $details->section_id = $question->section_id;
        $details->user_id = \Auth::user()->id;
        $details->save();
        $question->explanation = $request->input('explanation');
        $question->save();
        return redirect("/question/savenext/$id");
    }else{
        \Session::flash('danger','Sorry!! you cannot add an explanation without selecting the correct answer');
        return redirect("/question/$id");
    }
}
/*
 * 
 */
public function Verify($id){
    $question = Question::find($id);
    $question->verified = 1;
    $question->save();
    return redirect("/question/$id");
}
/*
 * 
 */
public function Correct($id, $answer){
    //$details = \App\Detail::where("question_id", $id)->update(['answer_id' => $answer, 'answered_by' =>\Auth::user()->id]);
    //$details = new \App\Detail();
//    $details->question_id = $id;
//    $details->answered_by = \Auth::user()->id; 
//    $details->answer_id = $answer;
//    $details->save();
    $question = Question::where("id",$id)->update(['answered' => 1, 'answered_by' =>\Auth::user()->id]);
    $answers = \App\Answer::where("question_id", $id)->update(['correct'=> 0]);
    $correct = \App\Answer::find($answer);
    $correct->correct = 1;
    $correct->save();
    \Session::flash('success','The correct answer has been selected, kindly add a brief explanation if its not added');
    return redirect("/question/$id");
}

public function upload(){
    return view("questions.upload");
}

public function uploadexcel(Request $request){
    if(Input::hasFile('questions')){
            $path = Input::file('questions')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $question = new Question();
                   // $this->returnsubjectid($value->subject);
                    $question->subject_id = $value->subject;
                    $question->section_id = $value->class;
                    $question->question = $value->question;
                    $question->user_id = \Auth::user()->id;
                    $question->created_at = date("Y-m-d H:i:s");
                    $question->updated_at = date("Y-m-d H:i:s");
                    if($question->save()){
                        \App\Answer::create([
                            'question_id' => $question->id,
                            'user_id' => \Auth::user()->id,
                            'answer' => $value->option_1,
                        ]);
                        \App\Answer::create([
                            'question_id' => $question->id,
                            'user_id' => \Auth::user()->id,
                            'answer' => $value->option_2,
                        ]);
                        \App\Answer::create([
                            'question_id' => $question->id,
                            'user_id' => \Auth::user()->id,
                            'answer' => $value->option_3,
                        ]);
                        \App\Answer::create([
                            'question_id' => $question->id,
                            'user_id' => \Auth::user()->id,
                            'answer' => $value->option_3,
                        ]);
                    }
                }
            }
            \Session::flash('success','The excel questions has been uploaded');
    }
    return redirect("/question");
}

public function trivia(){
    return view("questions.trivia");
}

public function randomize(Request $Requests){
    $subject = $Requests->input('subject');
    $topics = $Requests->input('topics');
    //$questions = Question::latest()->where(["subject_id" => $subject,'section_id' => \Auth::user()->section_id,['explanation', '<>', NULL]])->get();
    $questions = \App\detail::latest()->where(["subject_id" => $subject,'section_id' => \Auth::user()->section_id])->get();
   
    if($questions->count() <50){
         \Session::flash('danger','The system does not have enough questions for randomization, or the questions have not yet bee confirmed kindly try again later');
        return redirect('question/trivia');
    }
    $idscount = $questions->random(50);
    
    $randoms = [];
    foreach ($idscount as $value) {
        $randoms[] = $value->question_id;
    }
    
    $randomize = new \App\Random();
    $randomize->random_questions = serialize($randoms);
    $randomize->user_id = \Auth::user()->id;
    $randomize->save();
   
    $question = \App\Random::find($randomize->id);
    
    $arrays = $question->random_questions;
    $unserialize = unserialize($arrays);
    
    foreach ($unserialize as $value) {
       $details = \App\detail::find($value);
       if(!empty($details)){
           $details->randomized = ($details->randomized + 1);
           $details->save();
       }
       $trivia = new \App\Trivia();
       $trivia->question_id = $value;
       $trivia->random_id = $randomize->id;
       $trivia->user_id = \Auth::user()->id;
       $trivia->save();
    }
    
   $start = \App\Trivia::where(['random_id' => $randomize->id, 'user_id' => \Auth::user()->id])->first()->question_id;
   
   $question = Question::find($start);
   
    \Session::flash('success','The questions have been randomized, you are allowed to answer 50 questions, select the answer and the system will proceed to the next question');
   
   return view("questions.quiz", compact('question'))->with('random_id', $randomize->id);
      
    
}

public function proceed($id, $answer, $fk_random){
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
    
    $current_question = Question::find($id);
    
    $current = $id;
    $nextkey = array_search($current, $unserialize) + 1;
    if($nextkey == count($unserialize)) {
        $score = (\App\Trivia::where(['user_id' => \Auth::user()->id, 'random_id' => $fk_random, 'correct' => 1])->count()/50)*100;
        if($score < 30){
            $perfomance = "Fail";
        }else if($score > 30 && $score < 50){
            $perfomance = "Average";
        }else if($score > 50 && $score < 75){
            $perfomance = "Above average";
        }else if($score > 75 && $score < 85){
            $perfomance = "Excellent";
        }else if($score > 85){
            $perfomance = "Genius";
        }
        
        if(!empty($questions->group_id)){
            $groupdetails = \App\Group::find($questions->group_id);
            $groupdetails_subject_id = $groupdetails->subject_id;
            $groupdetails_section_id = $groupdetails->section_id;
        }else{
            $groupdetails_subject_id = $current_question->subject_id;
            $groupdetails_section_id = $current_question->section_id;
        }
        $result = new \App\Result();
        $result->user_id = \Auth::user()->id;
        $result->random_id = $fk_random;
        $result->trivia_result = $score;
        $result->perfomance = $perfomance;
        $result->group_id = $questions->group_id;
        $result->subject_id = $groupdetails_subject_id;
        $result->section_id = $groupdetails_section_id;
        $result->save();
        return redirect("users/profile");
    }

    $next = $unserialize[$nextkey];
    
    $question = Question::find($next);
    \Session::flash('success','The questions have been randomized, you are allowed to answer 50 questions, select the answer and the system will proceed to the next question');
    return redirect("/question/".$next."/nextquiz/".$fk_random);
   //return view("questions.quiz", compact('question'))->with('fk_random', $fk_random);
    
}

public function nextquiz($id, $fk_random){
   $question = Question::find($id);
    
   return view("questions.quiz", compact('question'))->with('random_id', $fk_random);
}

public function revise($id){
    $trivia = \App\Trivia::where(['random_id' => $id, 'user_id' => \Auth::user()->id])->first();
    $name = \App\Answer::find($trivia->answer)->answer;
    $question = Question::find($trivia->question_id);
    return view("questions.revise", compact('question', 'trivia', 'name'))->with('random_id', $id);
    
}

public function nextrevise($id, $fk_random){
    $questions = \App\Random::find($fk_random)->random_questions;
    $unserialize = unserialize($questions);
    
    $current = $id;
    $nextkey = array_search($current, $unserialize) + 1;
    if($nextkey == count($unserialize)) {
        return redirect("users/profile");
    }
    
    $trivia = \App\Trivia::where(['random_id' => $fk_random, 'question_id' => $unserialize[$nextkey], 'user_id' => \Auth::user()->id])->first();
   
    $name = \App\Answer::find($trivia->answer)->answer;
    $question = Question::find($unserialize[$nextkey]);
    
    return view("questions.revise", compact('question', 'trivia', 'name'))->with('random_id', $fk_random);
}

function testrelation(){
    $query = Question::with('subject')->select('questions.*');
    return Datatables::of($query)
            ->editColumn('name', '{!! str_limit($name, 60) !!}')
            ->make(true);
}

function verification(){
    $check = \App\Verified::where(['user_id' => \Auth::user()->id, 'section_id' => \Auth::user()->section_id, 'subject_id'=> \Auth::user()->subject_id])->delete();
    
        if(\Auth::user()->role_id == 4){
            $questions = Question::where(['subject_id' =>\Auth::user()->subject_id, 'section_id' =>\Auth::user()->section_id, 'answered' =>NULL])->get();
            foreach ($questions as $value) {
                $pending[] = $value->id;
            }
            $first = reset($pending);
            $unverifieds = new \App\Verified();
            $unverifieds->user_id = \Auth::user()->id;
            $unverifieds->pending = serialize($pending);
            $unverifieds->section_id = \Auth::user()->section_id;
            $unverifieds->subject_id = \Auth::user()->subject_id;
            $unverifieds->save();
            $question = Question::find($first);
            \Session::flash('success','This are the questions that do not have answers and/or explanation, select the answer and enter brief explanation');
    
        }else if(\Auth::user()->role_id == 3 || \Auth::user()->role_id == 5){

            $dataclerks = Question::where(['subject_id' =>\Auth::user()->subject_id, 'section_id' =>\Auth::user()->section_id])->get();
            
            foreach ($dataclerks as $value) {
                $pending[] = $value->id;
            }

            $first = reset($pending);
            $unverifieds = new \App\Verified();
            $unverifieds->user_id = \Auth::user()->id;
            $unverifieds->section_id = \Auth::user()->section_id;
            $unverifieds->subject_id = \Auth::user()->subject_id;
            $unverifieds->pending = serialize($pending);
            $unverifieds->save();
            $question = Question::find($first);
            \Session::flash('success','Kindly confirm the questions that you entered, please go and edit if need be');
    
        }
        
         $topics  = \App\Topic::where(['section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->get();
         
         return view("questions.view", compact('question', 'topics'))->with('qid', $first);
  
}

function savenext($id){
    $pending = \App\Verified::where(['user_id' => \Auth::user()->id,'section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->first();
    
    if(!empty($pending)){
        $unserialize = unserialize($pending->pending);
        $nextkey = array_search($id, $unserialize) + 1; 
        if($nextkey == count($unserialize)) {
             \Session::flash('success','You have managed to go through all the questions of the current class you are currently working on');
            return redirect("users/profile");
        }
        $question = Question::find($unserialize[$nextkey]);
        $topics  = \App\Topic::where(['section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->get();

        return view("questions.view", compact('question', 'topics'))->with('qid', $id);
    }else{
        $next = Question::where(['section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->pluck('id');
       
        $nextkeys = array_search($id, $next->toArray()) +1; 
        
        $question = Question::find($next[$nextkeys]);
        $topics  = \App\Topic::where(['section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->get();

        return view("questions.view", compact('question', 'topics'))->with('qid', $id);
    }
}

function savenextprev($id){
    $pending = \App\Verified::where(['user_id' => \Auth::user()->id,'section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->first();
    if(!empty($pending)){
        $unserialize = unserialize($pending->pending);
        $nextkey = array_search($id, $unserialize) - 1; 
        if($nextkey == -1) {
            return redirect("question/verification");
        }
        $question = Question::find($unserialize[$nextkey]);

        return view("questions.view", compact('question'))->with('qid', $id);
    }else{
        $next = Question::where(['section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->pluck('id');
       
        $nextkeys = array_search($id, $next->toArray()) -1; 
        if($nextkeys == -1) {
            return redirect("question");
        }
        $question = Question::find($next[$nextkeys]);
        $topics  = \App\Topic::where(['section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->get();

        return view("questions.view", compact('question', 'topics'))->with('qid', $id);
    }
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
    $question = Question::find($unserialize[$nextkey]);
    return view("questions.revise", compact('question', 'trivia', 'name'))->with('random_id', $random_id);
}

  
function listsubject($id){
    \Session::set('sub_id', $id);
    $sub_name = \App\Subject::find($id)->subject_name;
    return view('questions.subjects', compact('sub_name'))->with($id);
}


function getroupquestions($id, $groupid){
    $questions = \App\Random::find($id);
    $arrays = $questions->random_questions;
    $unserialize = unserialize($arrays);
    
    foreach ($unserialize as $value) {
       $details = \App\detail::find($value);
       if(!empty($details)){
           $details->randomized = ($details->randomized + 1);//count number of times it has been randomized
           $details->save();
       }
       $trivia = new \App\Trivia();
       $trivia->question_id = $value;
       $trivia->random_id = $id;
       $trivia->user_id = \Auth::user()->id;
       $trivia->save();
    }
    
   $start = \App\Trivia::where(['fk_random' => $id, 'user_id' => \Auth::user()->id])->first()->question_id;
   
   $question = Question::find($start);
   
    \Session::flash('success','The questions have been randomized, you are allowed to answer 50 questions, select the answer and the system will proceed to the next question');
   
   return view("questions.quiz", compact('question'))->with('fk_random', $id);
}

function verified(){
    $check = \App\Verified::where(['user_id' => \Auth::user()->id, 'section_id' => \Auth::user()->section_id, 'subject_id'=> \Auth::user()->subject_id])->delete();
    
        if(\Auth::user()->role_id == 4){
            $questions = Question::where(['subject_id' =>\Auth::user()->subject_id, 'section_id' =>\Auth::user()->section_id, 'answered' =>1])->get();
            foreach ($questions as $value) {
                $pending[] = $value->id;
            }
            $first = reset($pending);
            $unverifieds = new \App\Verified();
            $unverifieds->user_id = \Auth::user()->id;
            $unverifieds->pending = serialize($pending);
            $unverifieds->section_id = \Auth::user()->section_id;
            $unverifieds->subject_id = \Auth::user()->subject_id;
            $unverifieds->save();
            $question = Question::find($first);
            \Session::flash('success','This are the questions that do not have answers and/or explanation, select the answer and enter brief explanation');
    
        }else if(\Auth::user()->role_id == 3 || \Auth::user()->role_id == 5){

            $dataclerks = Question::where(['subject_id' =>\Auth::user()->subject_id, 'section_id' =>\Auth::user()->section_id])->get();
            
            foreach ($dataclerks as $value) {
                $pending[] = $value->id;
            }

            $first = reset($pending);
            $unverifieds = new \App\Verified();
            $unverifieds->user_id = \Auth::user()->id;
            $unverifieds->section_id = \Auth::user()->section_id;
            $unverifieds->subject_id = \Auth::user()->subject_id;
            $unverifieds->pending = serialize($pending);
            $unverifieds->save();
            $question = Question::find($first);
            \Session::flash('success','Kindly confirm the questions that you entered, please go and edit if need be');
    
        }
        
         $topics  = \App\Topic::where(['section_id' => \Auth::user()->section_id, 'subject_id' =>\Auth::user()->subject_id])->get();
         
         return view("questions.view", compact('question', 'topics'))->with('qid', $first);
}
    
}
