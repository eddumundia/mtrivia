<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;



//define('USERNAME', 'sandbox');
//define('APIKEY', 'd1f4320a3f0eba2afc35d16b665ff627252d7cb68ac49fd5d336cc7ccca543d1');
define('USERNAME', 'masomotrivia');
define('APIKEY', '1572f1b0e2a4b0ef480bf1cfda12e2ced0ff50c824855b42cf2d306a6d05312f');
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile', 'role_id', 'section_id', 'code', 'parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
   ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
   public function subject(){
        return $this->belongsTo(Subject::class);
    }
    
    public function section(){
        return $this->belongsTo(Sections::class);
    }
    
    public function role(){
        return $this->belongsTo(Role::class);
    }
    
    public function getcounts(){
        return [
            'students' => User::where(['role_id' =>1])->count(),
            'parents' => User::where(['role_id' =>2])->count(),
            'clerks' => User::where(['role_id' =>3])->count(),
            'teachers' => User::where(['role_id' =>4])->count(),
            'payments' => \DB::table('payments')->sum('amount'),

        ];
    }
    
    public function getStudentData($id){
       return [
           ''
       ];
    }
    
    public function getUserSummary(){
        return [
            'questions' => Question::where(['user_id' => \Auth::user()->id])->count(),
            'verified' => Question::where("verified_by")->count(),
            'explanation' => Question::where("explanation")->count(),
        ];
    }
    
    public function getIndividualRecord($id){
        return Question::where(['user_id' =>"$id"])->count();
    }
    
     public function getSubjectRecord($id, $user_id){
        return Question::where(['subject_id' =>"$id", 'user_id' => $user_id])->count();
    }
    
    public function getSubjectVerified($id, $user_id){
        return Question::where(['subject_id' =>"$id", 'answered' => 1, 'answered_by' => $user_id])->count();
    }
    
    public function getRecords(){
        return [
            'ksw4' => Question::where(['section_id' => 4, 'subject_id' =>1])->count(),
            'eng4' => Question::where(['section_id' => 4, 'subject_id' =>3])->count(),
            'mat4' => Question::where(['section_id' => 4, 'subject_id' =>2])->count(),
            'sss4' => Question::where(['section_id' => 4, 'subject_id' =>4])->count(),
            'sci4' => Question::where(['section_id' => 4, 'subject_id' =>5])->count(),
            
            'ksw5' => Question::where(['section_id' => 5, 'subject_id' =>1])->count(),
            'eng5' => Question::where(['section_id' => 5, 'subject_id' =>3])->count(),
            'mat5' => Question::where(['section_id' => 5, 'subject_id' =>2])->count(),
            'sss5' => Question::where(['section_id' => 5, 'subject_id' =>4])->count(),
            'sci5' => Question::where(['section_id' => 5, 'subject_id' =>5])->count(),
            
            'ksw6' => Question::where(['section_id' => 6, 'subject_id' =>1])->count(),
            'eng6' => Question::where(['section_id' => 6, 'subject_id' =>3])->count(),
            'mat6' => Question::where(['section_id' => 6, 'subject_id' =>2])->count(),
            'sss6' => Question::where(['section_id' => 6, 'subject_id' =>4])->count(),
            'sci6' => Question::where(['section_id' => 6, 'subject_id' =>5])->count(),
            
            'ksw7' => Question::where(['section_id' => 7, 'subject_id' =>1])->count(),
            'eng7' => Question::where(['section_id' => 7, 'subject_id' =>3])->count(),
            'mat7' => Question::where(['section_id' => 7, 'subject_id' =>2])->count(),
            'sss7' => Question::where(['section_id' => 7, 'subject_id' =>4])->count(),
            'sci7' => Question::where(['section_id' => 7, 'subject_id' =>5])->count(),
            
            'ksw8' => Question::where(['section_id' => 8, 'subject_id' =>1])->count(),
            'eng8' => Question::where(['section_id' => 8, 'subject_id' =>3])->count(),
            'mat8' => Question::where(['section_id' => 8, 'subject_id' =>2])->count(),
            'sss8' => Question::where(['section_id' => 8, 'subject_id' =>4])->count(),
            'sci8' => Question::where(['section_id' => 8, 'subject_id' =>5])->count(),
        ];
    }
    
    public function checkSubscription($id){
        $check = \App\Subscription::where(['user_id' => $id, 'status' => 1])->first();
        if(!empty($check)){
            $dt = Carbon::parse($check->expiry_date);

            if($dt->diffInDays() <= 31){
                return 1;
            }else{
                return 2;
            }
        }else{
            $today = new Carbon();
            $model = new \App\Subscription();
            $model->user_id = $id;
            $model->track_id = 'FREE';
            $model->amount = 0.00;
            $model->status = 1;
            $model->expiry_date = $today->addDays(30);
            $model->payment_code = 'FREE';
            $model->save();
            return 2;
        }
    }
    
    public function sendSMS($recipients, $message, $userid){
        $gateway    = new \AfricasTalkingGateway(USERNAME, APIKEY);
        try 
            { 
              // Thats it, hit send and we'll take care of the rest. 
              $results = $gateway->sendMessage($recipients, $message);

              foreach($results as $result) {
                $model = new Message();
                $model->mobile = $result->number;
                $model->user_id = $userid;
                $model->status = $result->status;
                $model->message_id = $result->messageId;
                $model->status = $result->status;
                $model->cost = $result->cost;
                $model->save();
                // status is either "Success" or "error message"
//                echo " Number: " .$result->number;
//                echo " Status: " .$result->status;
//                echo " MessageId: " .$result->messageId;
//                echo " Cost: "   .$result->cost."\n";
              }
            }
            catch ( AfricasTalkingGatewayException $e )
            {
              echo "Encountered an error while sending: ".$e->getMessage();
            }
    }
    
    public function getFields(){
       $fields = array("live"=> "1",
            "oid"=> date('Y')."".\Auth::user()->code,
            "inv"=> date('Y')."".\Auth::user()->code,
            "ttl"=> "200",
            "tel"=> \Auth::user()->mobile,
            "eml"=> \Auth::user()->email,
            "vid"=> "demo",
            "curr"=> "KES",
            "p1"=> "",
            "p2"=> "",
            "p3"=> "",
            "p4"=> "200",
            "cbk"=> $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],
            "cst"=> "1",
            "crl"=> "2"
        );
       return $fields;
    }
}
