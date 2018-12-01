<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Yajra\Datatables\Datatables;

use App\Question;

class DatatablesController extends Controller
{
    /**
 * Displays datatables front end view
 *
 * @return \Illuminate\View\View
 */
public function getIndex()
{
    return view('datatables.index');
}

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData()
{
    $permissions = \Auth::user()->role_id;
    if($permissions == 3){
        $questions = \App\Question::with('subject', 'user')->where(['user_id' => \Auth::user()->id])->select('questions.*');  
    }else if($permissions == 4){
        $questions = \App\Question::with('subject', 'user')->where(['subject_id' => \Auth::user()->subject_id, 'section_id' => \Auth::user()->section_id])->select('questions.*'); 
    }else if($permissions == 5){
        $questions = \App\Question::with('subject', 'user')->select('questions.*');  
    }
    
    return Datatables::of($questions)
                ->addColumn('action', function(Question $question){
                return '<a href="question/'. $question->id .'" class="btn btn-primary">View</a>';})
                ->editColumn('question', '{!! str_limit($question, 60) !!}')
                ->setRowClass(function ($question) {
                    return $question->id % 2 == 0 ? 'alert-success' : 'alert-warning';
                }) 
                ->make(true);
    }
    
    public function anyStudent(){
        $id= \Session::get('sub_id');
        $questions =  \App\Question::with('subject', 'user')->where(['subject_id' => $id, 'section_id' =>\Auth::user()->section_id])->select('questions.*');  
        return Datatables::of($questions)
                ->editColumn('question', '{!! str_limit($question, 60) !!}')
                ->setRowClass(function ($question) {
                    return $question->id % 2 == 0 ? 'alert-success' : 'alert-warning';
                })
                ->make(true);
    }
    
    public function anyStudentlist(){
        $users = \App\User::with('subject')->where(['role_id' => 1])->select('users.*');  
        return Datatables::of($users)
                ->make(true);
    }
    
    public function anyClerklist(){
        $users = \App\User::with('subject')->where(['role_id' => 3])->select('users.*');  
        return Datatables::of($users)
                ->addColumn('action', function(\App\User $users){
                return '<a href="clerkprofile/'. $users->id .'" class="btn btn-primary">View</a>';})
                ->setRowClass(function ($question) {
                    return $question->id % 2 == 0 ? 'alert-success' : 'alert-warning';
                }) 
                ->make(true);
    }
    
    public function anyTeacherlist(){
        $users = \App\User::with('subject')->where(['role_id' => 4])->select('users.*');  
        return Datatables::of($users)
                ->addColumn('action', function(\App\User $users){
                return '<a href="clerkprofile/'. $users->id .'" class="btn btn-primary">View</a>';})
                ->setRowClass(function ($question) {
                    return $question->id % 2 == 0 ? 'alert-success' : 'alert-warning';
                }) 
                ->make(true);
    }
    public function anyResults(){
    $result = \App\Result::with('subject')->where(['user_id' => \Auth::user()->id, 'group_id' => NULL])->select('results.*');
   
    
    return Datatables::of($result)
                ->make(true);
    }
    
}
