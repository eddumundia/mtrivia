<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TopicController extends Controller
{
    public function create($id){
        return view("topic.create")->with('id', $id);
    }
    public function store(Request $Requests, $id){
        $topic =  new \App\Topic();
        $topic->section_id = \Auth::user()->section_id;
        $topic->subject_id = \Auth::user()->subject_id;
        $topic->user_id = \Auth::user()->id;
        $topic->topic = $Requests->input('topic');
        if($topic->save()){
            return redirect("question/$id");
        }
    }
}
