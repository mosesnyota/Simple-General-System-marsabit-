<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use App\FeePayment;
use App\SentSMSLog;

class SmsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sms.smsindex');
    }

    public function sendsms(Request $request){
        $input = $request->all();
        $target = $input['targetgroup'];
        $mymessage = $input['messages'];
        //<option value="students">All Students</option>
        //<option value="staff">All Staff</option>
        //<option value="alumni">Alumni</option>
        //<option value="customers">Registered Customers</option>
        //<option value="all">Every Body</option>

        $sqlQuery = "";

        if($target == 'students'){
            $sqlQuery = "SELECT `student_id`,`student_no`,`first_name`,`middle_name`,`surname`,`phone`, cur_status, CHAR_LENGTH(phone) FROM `students`
            WHERE `deleted_at` IS NULL AND cur_status = 'Active' AND phone IS NOT NULL AND phone != '0' 
            AND (CHAR_LENGTH(phone) > 8 AND CHAR_LENGTH(phone) < 13 AND phone REGEXP '[0-9]' ) and student_id =404 ";
        }else if($target == 'staff'){
            $sqlQuery = "";
        }else if($target == 'alumni'){
            $sqlQuery = "";
        }else if($target == 'customers'){
            $sqlQuery = "";
        }

        $toSendTo =  DB::select( DB::raw($sqlQuery));
        foreach($toSendTo as $cst){ 
            $phone = $cst ->phone;
            $name = $cst ->first_name." ".$cst ->middle_name." ".$cst ->surname;
            //this eliminates phones with characters or special characters
            if (preg_match('/[A-Za-z]/', $phone) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $phone) )
                { 
                    //Data cleaning to eliminate phone numbers with characters
                    //echo   $phone . '    Contains at least one letter and one number'. "<br>";
                }  else{
                   
                
                $msisdn = $phone;
                $Message = $mymessage;
                $messages = urlencode(stripslashes($Message)); // the message to the recepients	
                $ch = curl_init();
                $myurl = "https://client.airtouch.co.ke:9012/sms/api/?issn=DONBOSCOMBT&msisdn=$msisdn&text=$messages&username=donbosco&password=b28630c1a54cce60c3b89d4e72909387";
                curl_setopt($ch, CURLOPT_URL,  $myurl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                $json = json_decode($output);
                //var_dump(json_decode($output));
                $statuscode =  $json->status_code;
                $statusdesc =  $json->status_desc;
                
                $sentmsgslog = Array();
                $sentmsgslog['phone'] =  $phone ;
                $sentmsgslog['statuscode'] = $statuscode  ;
                $sentmsgslog['statusdesc'] =   $statusdesc;
                $sentmsgslog['messages'] =  $mymessage ;
                $sentmsgslog['targetgroup'] =  $target  ;
                $sentmsgslog['name'] =   $name  ;
                SentSMSLog::create($sentmsgslog);


            
 
            }//end else... 

        }//end foreach

        return redirect()->action(
            'SmsController@index'
        );

        
    }


    public function sentsms(){
        $sms =SentSMSLog::all();
        return view('sms.sent_sms',compact('sms'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function smscomm(){
        return view('school.smsindex');
    }
}
