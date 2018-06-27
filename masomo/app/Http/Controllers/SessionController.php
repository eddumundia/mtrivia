<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Person;


//new \App\Classes\AfricasTalkingGateway;

use App\User;

class SessionController extends Controller
{
    
    public function create(){
        return view('sessions.create');
    }
    
    public function destroy(){
        auth()->logout();
        return redirect('/');
    }
    
    public function store(){
        $user = User::where(['code'=>request('code')])->first();
        if($user->count() !=0){
            if($user->checkSubscription($user->id) ==2){
                auth()->login($user); 
            }else{
                auth()->login($user); 
                return redirect('subscription/create');
            }
        }
        
        return redirect('home');
    }
    
    public function storeperson(Request $request, $id){
        $person  = new \App\Participant();
        $person->user_id = $id;
        $person->role_id =  $request->session()->get('role_id');
        $person->save();
        
        return redirect("/home");
    }
    
     public function generateRandom(){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(10, 99)
            . mt_rand(10, 99)
            . $characters[rand(0, strlen($characters) - 1)];
        $string = str_shuffle($pin);
        $record = User::where(['code'=>$string])->first();
        if($record->count() !=0){
            return $string;
        }
        $this->generateRandom();
        
    }
    
    public function forgot(){
        return view('sessions.changepwd');
    }
    
    public function reset(Request $Requests){
       $mobile = $Requests->input('phonenumber');
       
       $data = \App\User::where(['mobile' => $mobile])->first();
       if(empty($data)){
            return $this->generateRandom();
       }else{
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $pin = mt_rand(10, 99)
                . mt_rand(10, 99)
                . $characters[rand(0, strlen($characters) - 1)];
            $string = str_shuffle($pin);
            $data->code = $string;
            if($data->save()){
                $message = "Your new code for login is $string";
                $sendsms = $data->sendSMS($mobile, $message, $data->id);
                \Session::flash('success',"A code has been sent to $mobile, kindly use it to login");
                return redirect("/login");
            }
       }
    }

}
