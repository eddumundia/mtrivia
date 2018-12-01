<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SiteController extends Controller
{
    public function home(){
        return view("site.home");  
    }
    
    public function aboutus(){
        return view("site.aboutus");  
    }
    
    public function team(){
        return view("site.team");  
    }
    
    public function procedure(){
        return view("site.procedure");  
    }
    
    public function contactus(){
        return view("site.contactus");  
    } 
    public function mail(Request $request){
         $this->validate(request(), [
            'subject' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
         
         $to = "eddumundia@gmail.com";
         $subject = $request->input('subject');
         $email = $request->input('email');
         $message = $request->input('message');
         $headers = "From: $email" . "\r\n" .
                    "Reply-To: $email" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
         mail($to, $subject, $message, $headers);
          \Session::flash('success',"Thank you for contacting us, will respond within the shortest time possible");
        return view("site.contactus");  
    }
}
