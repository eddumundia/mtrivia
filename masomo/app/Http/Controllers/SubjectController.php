<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SubjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
       $subjects = \App\Subject::all();
       return view("subjects.index", compact('subjects'));
   }
   
   public function create(){
       $categories = \App\Category::all();
       return view("subjects.create", compact('categories'));
   }
   
   public function store(Request $Requests){
       $subject = new \App\Subject();
       $subject->category_id = $Requests->input('category_id');
       $subject->subject_name = $Requests->input('subject_name');
       $subject->save();
        return redirect("/home");
   }
}
