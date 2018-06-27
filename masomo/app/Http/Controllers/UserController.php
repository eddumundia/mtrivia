<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $users = \App\User::all();
        
        return view("users.index", compact('users'));
    }
    
    public function students(){
        
        return view('users.students');
    }
    
    public function studentquery(){
        //$users = \App\User::query();
        //$records = \App\User::where(['role_id' => 1])->get();
        return Datatables::of(\App\User::query())
            ->make(true);
    }


    public function parents(){
        $records = \App\User::where(['role_id' => 2])->get();
        return view('users.students', compact('records'));
    }
    
    public function staff(){
        $records = \App\User::where(['role_id' => 4])->get();
        return view('users.teachers');
    }
    
    public function clerks(){
        $records = \App\User::where(['role_id' => 3])->get();
        return view('users.clerks');
    }
    
    public function settings(){
        $subjects = \App\Subject::all();
        return view("users.settings", compact('subjects'));
    }
    /*
     * shows profile based on logged in person
     */
    
    public function profile(){
        $id = Auth()->user()->id;
        $user = \App\User::find($id);
        //$trivias = \App\Result::where(['user_id' => \Auth::user()->id, ['group_id', '<>', NULL]])->get();
        $trivias = \App\Result::where(['user_id' => \Auth::user()->id, 'group_results'=> NULL])->get();
        $pending = \App\Trivia::where(['user_id' => \Auth::user()->id, 'answer' => NULL])->first();
        
        $questions = new \App\Question();
        $entered  = "";
        $verifieds = "";
        $deleted = "";
        if($user->role_id == 1){
            $data = $user->getStudentData($id);
            $view ="student_profile";
            $count ="";
        }else if($user->role_id == 2){
           $data = \App\User::where(['parent_id' => $user->id])->get();
           $view ="parent_profile";
           $count ="";
        }else if($user->role_id == 3){
           $data ="";
           $view ="staff_profile"; 
           
           $count = $user->getUserSummary();
        }else if($user->role_id == 4){
            $entered  = $questions->enteredQuestions();
           $verifieds = $questions->verifiedQuestions();
           $deleted = $questions->deletedQuestions();
           $data ="";
           $view ="teacher_profile"; 
           $count ="";
        }else{
           $entered  = $questions->enteredQuestions();
           $verifieds = $questions->verifiedQuestions();
           $deleted = $questions->deletedQuestions();
           $data ="";
           $view ="teacher_profile"; 
           $count ="";
        }
        
        return view("users.$view", compact('user', 'data', 'trivias', 'count', 'entered', 'verifieds', 'deleted', 'pending'));
    }
    
    public function child($id){
        $user = \App\User::find($id);
        $data = \App\User::where(['parent_id' => $user->parent_id])->get();
        $trivias = \App\Result::where(['user_id' => $id])->get();
        return view("users.student_profile", compact('user', 'data', 'trivias'));
    }
    
    public function teacherprofile($id){
        $user = \App\User::find($id);
      return view("users.teacher_profile", compact('user', 'data'));  
    }
    
     public function clerkprofile($id){
        $trivias = \App\Result::where(['user_id' => \Auth::user()->id])->get();
        $user = \App\User::find($id);
        return view("users.clerk_profile", compact('user', 'data', 'trivias'));  
    }
    
    public function changeclass(Request $Requests){
        $user = \App\User::find(\Auth::user()->id);
        $user->section_id = $Requests->input('section_id');
        $user->save();
        return redirect("users/profile");
    }
    
    public function addchild($id){
         return view("users.addchild")->with('id', $id);  
    }
    
    public function newchild(Request $request){
        $parent = \App\User::find(\Auth::user()->id);
        $this->validate(request(), [
            'name' => 'required|max:255',
        ]);
        
         $user = \App\User::create([
            'name' =>$request->input('name'),
            'password' => $parent->password,
             'email' =>str_random(3).'admin@masomotrivia.com',
            'mobile' =>'0710306895',
             'parent_id' => \Auth::user()->id,
            'role_id' => 1,
            'section_id' =>$request->input('currentclass'),
            'code' => $this->generateRandom(),
        ]);
        \Session::flash('success','The child has been added successfully and his code will be sent to '. $parent->mobile);
        return redirect("users/profile");
        
    }
    
      public function generateRandom(){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(10, 99)
            . mt_rand(10, 99)
            . $characters[rand(0, strlen($characters) - 1)];
        // shuffle the result
        $string = str_shuffle($pin);

        return $string;
    }
    
    public function sendsms(){
        return "hahhaha";
    }
}
