<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Carbon\Carbon;

Route::get('/', 'HomeController@index');

Route::get("/register", "RegistrationController@create");

Route::post("/register", "RegistrationController@store");


Route::get("/logout", "SessionController@destroy");

Route::get("/login", "SessionController@create");

Route::post("/login", "SessionController@store");

Route::post("/reset", "SessionController@reset");

Route::get('/home', 'HomeController@index');

Route::get('/message', 'MessageController@index');

Route::get('/signup', [
    'as'   => 'question.register',
    'uses' => 'RegistrationController@show'
]);

Route::get('/redirect/{values}', [
    'as'   => 'redirect',
    'uses' => 'RegistrationController@redirect'
]);

Route::get('/forgot', [
    'as'   => 'forgot',
    'uses' => 'SessionController@forgot'
]);


Route::get('/storeperson/{values}', [
    'as'   => 'storeperson',
    'uses' => 'SessionController@storeperson'
]);


Route::post('/question/uploadexcel', [
    'as'   => 'question.uploadexcel',
    'uses' => 'QuestionController@uploadexcel'
]);

Route::get('/question/verified', [
    'as'   => 'question.verified',
    'uses' => 'QuestionController@verified'
]);


Route::get('/question/savenext/{id}', [
    'as'   => 'question.savenext',
    'uses' => 'QuestionController@savenext'
]);

Route::get('/question/savenextprev/{id}', [
    'as'   => 'question.savenextprev',
    'uses' => 'QuestionController@savenextprev'
]);

Route::get('/group/joingroup/{id}', [
    'as'   => 'group.joingroup',
    'uses' => 'GroupController@joingroup'
]);


Route::get('/question/getroupquestions/{id}/{groupid}', [
    'as'   => 'question.getroupquestions',
    'uses' => 'QuestionController@getroupquestions'
]);


Route::get('/question/verification', [
    'as'   => 'question.verification',
    'uses' => 'QuestionController@verification'
]);

Route::get('/group/show', [
    'as'   => 'group.show',
    'uses' => 'GroupController@show'
]);

Route::get('/group/join/{id}', [
    'as'   => 'group.join',
    'uses' => 'GroupController@join'
]);

Route::get('/group/revise/{id}', [
    'as'   => 'group.revise',
    'uses' => 'GroupController@revise'
]);

Route::get('/group/{category}/proceedgroup/{answer}/{section}', [
    'as'   => 'group.proceed',
    'uses' => 'GroupController@proceedgroup'
]);

Route::get('/group/{category}/prevrevise/{answer}', [
    'as'   => 'group.prevrevise',
    'uses' => 'GroupController@prevrevise'
]);

Route::get('/question/{category}/prevrevise/{answer}', [
    'as'   => 'question.prevrevise',
    'uses' => 'QuestionController@prevrevise'
]);


Route::get('question/getroupquestions/{id}', [
    'as'   => 'question.getroupquestions',
    'uses' => 'QuestionController@getroupquestions'
]);

Route::get('/group/{category}/nextquiz/{random}', [
    'as'   => 'group.nextquiz',
    'uses' => 'GroupController@nextquiz'
]);




Route::get('/users/students', [
    'as'   => 'user.students',
    'uses' => 'UserController@students'
]);

Route::get('/users/parents', [
    'as'   => 'user.parents',
    'uses' => 'UserController@parents'
]);

Route::get('/users/sendsms/{mobile}', [
    'as'   => 'user.sendsms',
    'uses' => 'UserController@sendsms'
]);

Route::get('/users/addchild/{id}', [
    'as'   => 'user.addchild',
    'uses' => 'UserController@addchild'
]);

Route::post('/users/newchild', [
    'as'   => 'user.newchild',
    'uses' => 'UserController@newchild'
]);


Route::get('/users/staff', [
    'as'   => 'user.parents',
    'uses' => 'UserController@staff'
]);

Route::get('/users/studentquery', [
    'as'   => 'user.studentquery',
    'uses' => 'UserController@studentquery'
]);

Route::get('/users/settings', [
    'as'   => 'user.settings',
    'uses' => 'UserController@settings'
]);

Route::get('/users/clerks', [
    'as'   => 'user.clerks',
    'uses' => 'UserController@clerks'
]);

Route::get('/users/profile', [
    'as'   => 'user.profile',
    'uses' => 'UserController@profile'
]);

Route::get('/users/child/{child}', [
    'as'   => 'user.child',
    'uses' => 'UserController@child'
]);

Route::get('/users/teacherprofile/{child}', [
    'as'   => 'user.teacherprofile',
    'uses' => 'UserController@teacherprofile'
]);

Route::get('/users/clerkprofile/{child}', [
    'as'   => 'user.clerkprofile',
    'uses' => 'UserController@clerkprofile'
]);

Route::post('/users/changeclass', [
    'as'   => 'user.changeclass',
    'uses' => 'UserController@changeclass'
]);

Route::get('/users', 'UserController@index');


Route::get('/question/{category}/proceed/{answer}/{section}', [
    'as'   => 'question.proceed',
    'uses' => 'QuestionController@proceed'
]);

Route::get('/question/{category}/nextrevise/{answer}', [
    'as'   => 'question.nextrevise',
    'uses' => 'QuestionController@nextrevise'
]);

Route::get('/group/{category}/nextrevise/{answer}', [
    'as'   => 'group.nextrevise',
    'uses' => 'GroupController@nextrevise'
]);


Route::get('/question/{category}/verify', [
    'as'   => 'question.verify',
    'uses' => 'QuestionController@verify'
]);

Route::get('/question/upload', [
    'as'   => 'question.upload',
    'uses' => 'QuestionController@upload'
]);



Route::post('/question/randomize', [
    'as'   => 'question.randomize',
    'uses' => 'QuestionController@randomize'
]);

Route::post('/question/uploadexcel', [
    'as'   => 'question.uploadexcel',
    'uses' => 'QuestionController@uploadexcel'
]);

Route::get('/question', [
    'as'   => 'question.index',
    'uses' => 'QuestionController@index'
]);

Route::get('/question/create', [
    'as'   => 'question.create',
    'uses' => 'QuestionController@create'
]);


Route::get('/question/trivia', [
    'as'   => 'question.trivia',
    'uses' => 'QuestionController@trivia'
]);

Route::get('/question/indexlist', [
    'as'   => 'question.indexlist',
    'uses' => 'QuestionController@indexlist'
]);


Route::get('/question/{category}/correct/{answer}', [
    'as'   => 'question.correct',
    'uses' => 'QuestionController@correct'
]);

Route::get('/question/delete/{id}', function($id){
    \App\Question::destroy($id);
    \Session::flash('success','The record has been deleted successfully');
    return redirect("/question");
});

Route::get('/question/{category}/revise', [
    'as'   => 'question.revise',
    'uses' => 'QuestionController@revise'
]);


Route::get('/question/{category}/nextquiz/{random}', [
    'as'   => 'question.nextquiz',
    'uses' => 'QuestionController@nextquiz'
]);


Route::get('/question/testdrawgraph', [
    'as'   => 'question.testdrawgraph',
    'uses' => 'QuestionController@testdrawgraph'
]);

Route::get('/question/{category}/nextquiz/{random}', [
    'as'   => 'question.nextquiz',
    'uses' => 'QuestionController@nextquiz'
]);

Route::post('/saveexplanation/{category}', [
    'as'   => 'question.saveexplanation',
    'uses' => 'QuestionController@saveexplanation'
]);


Route::get('/question/listsubject/{category}', [
    'as'   => 'question.listsubject',
    'uses' => 'QuestionController@listsubject'
]);

Route::get('/subscription/create', [
    'as'   => 'subscription.create',
    'uses' => 'SubscriptionController@create'
]);

Route::get('/topic/create/{id}', [
    'as'   => 'topic.create',
    'uses' => 'TopicController@create'
]);

Route::post('/topic/{id}', [
    'as'   => 'topic.store',
    'uses' => 'TopicController@store'
]);
//Route::post("/topic", "TopicController@store");


Route::get('/subscription/storage',function(){
    $check = \App\Subscription::where(['user_id' => \Auth::user()->id, 'status' => 1])->first();
    $check->status = 0;
    $check->save();
    $trackid = Input::get('pesapal_transaction_tracking_id');
    $reference = Input::get('pesapal_merchant_reference');
    $subscription = new App\Subscription();
    $today = new Carbon();
    $subscription->track_id = $trackid;
    $subscription->reference_id = $reference;
    $subscription->user_id = \Auth::user()->id;
    $subscription->amount = 200;
    $subscription->status = 1;
    $subscription->expiry_date = $today->addDays(30);
    $subscription->save();
    \Session::flash('success',"The payment has been received, waiting for approval, the expiry date will be on $subscription->expiry_date");
    return redirect('users/profile');
});

//Route::controller('/subscription/storage/{pesapal_transaction_tracking_id}/{pesapal_merchant_reference}', [
//    'as'   => 'subscription.storage',
//    'uses' => 'SubscriptionController@storage'
//]);
Route::resource('question','QuestionController');

Route::resource('category','CategoryController');
Route::resource('subject','SubjectController');

Route::controller('datatables', 'DatatablesController', [
    'anyData'  => 'datatables.data',
    'anyStudent' => 'datatables.student',
    'anyStudentlist' => 'datatables.studentlist',
    'anyClerklist'  => 'datatables.clerklist',
    'anyTeacherlist'  => 'datatables.teacherlist',
    'getIndex' => 'datatables',
]);

//Route::resource('topic','TopicController');






