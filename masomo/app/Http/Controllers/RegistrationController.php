<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class RegistrationController extends Controller
{
    
    public function create(){
        return view("registration.create");
    }
    
    public function store(Request $request){
        $this->validate(request(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'required|max:10|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        
        $user = User::create([
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'mobile' =>$request->input('mobile'),
            'password' => bcrypt($this->generateRandom()),
            //'role_id' => $request->session()->get('role_id'),
            'section_id' =>$request->input('currentclass'),
            'role_id' =>$request->input('role_id'),
            'code' => $this->generateRandom(),
        ]);
        
        $model = new User();
        $message = "CONGRATULATIONS, Your registration has been successful. Use $user->code code to login for you to play, have fun and learn.";
        $model->sendSMS($user->mobile, $message, $user->id);
       // auth()->login($user);
        \Session::flash('success',"A code has been sent to $user->mobile, kindly use it to login");
        return redirect("/home");
       // return redirect("storeperson/$user->id");
    }
    
    public function show(){
        return view("registration.select");
    }
    
    public function redirect(Request $request, $id){
        $request->session()->put('role_id', $id);
        return redirect("/register");
    }
    
    public function generateRandom(){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(10, 99)
            . mt_rand(10, 99)
            . $characters[rand(0, strlen($characters) - 1)];
        // shuffle the result
        $string = str_shuffle($pin);
        $record = User::where(['code'=> $string])->first();
        if(empty($record)){
            return $string;
        }
        $this->generateRandom();
        
    }
    
}
