<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SubscriptionController extends Controller
{
    //
    
    function create(){
        
        $model =  new \App\User();
        $fields = $model->getFields();
     
        return view("subscription.create", compact('fields'));
    }
    
    function storages(){
        $trackid = Input::get('pesapal_transaction_tracking_id');
        $reference = Input::get('pesapal_merchant_reference');
        $subscription = new App\Subscription();
        $today = new Carbon();
        $subscription->track_id = $trackid;
        $subscription->reference_id = $reference;
        $subscription->user_id = \Auth::user()->id;
        $subscription->amount = 200;
        $subscription->expiry_date = $today->addDays(30);
        $subscription->save();
        \Session::flash('success',"The payment has been received, waiting for approval, the expiry date will be on $subscription->expiry_date");
        return redirect('users/profile');
    }
}
