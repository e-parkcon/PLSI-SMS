<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RECVMSG;
use App\MSGLOG;
use App\TIXNUM;

use DB;
use Auth;
use Session;
use Response;

class SMSDashboard extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function sms_dashboard(){
        // $test   =   TIXNUM::where('TaskNumber', 'S-20170320-1')->first();
        // dd($test);
        $recvmsg    =  DB::select('SELECT *, 
                    (SELECT telcom.telcom FROM telcom WHERE area_code = SUBSTR(recvmsg.telnum,3,3)) AS network
                    , (SELECT userid FROM msglog WHERE internalkey = recvmsg.internalkey LIMIT 1) AS empno,
                    (SELECT brchname FROM FSReport.customer_branch WHERE (custcode = SUBSTR(recvmsg.text_message,1,2) AND brchcode = SUBSTR(recvmsg.text_message,5,4)) 
                    OR (custcode = SUBSTR(recvmsg.text_message,1,2) AND brchcode = SUBSTR(recvmsg.text_message,4,4))) AS client
                    FROM recvmsg WHERE status != "C" ORDER BY sentdate, senttime ASC');
        // dd($recvmsg);

        return view('sms_dashboard.dashboard')->with('receive_msg', $recvmsg);
    }

    public function recvmsg_ajax(){
        $recvmsg    =   DB::select('SELECT *, 
                                (SELECT telcom.telcom FROM telcom WHERE area_code = SUBSTR(recvmsg.telnum,3,3)) AS network
                                , (SELECT userid FROM msglog WHERE internalkey = recvmsg.internalkey LIMIT 1) AS empno,
                                (SELECT brchname FROM FSReport.customer_branch WHERE (custcode = SUBSTR(recvmsg.text_message,1,2) AND brchcode = SUBSTR(recvmsg.text_message,5,4)) 
                                OR (custcode = SUBSTR(recvmsg.text_message,1,2) AND brchcode = SUBSTR(recvmsg.text_message,4,4))) AS client
                                FROM recvmsg WHERE status != "C" ORDER BY sentdate, senttime ASC');
        
        return Response::json($recvmsg);
    }


    public function phone_call(Request $request){

        MSGLOG::create([
            'internalkey'   =>  $request->internalkey,
            'txndate'       =>  date('Y-m-d'),
            'txntime'       =>  date('H:i:s'),
            'remarks'       =>  'CALLING',
            'userid'        =>  Auth::user()->empno
        ]);

        RECVMSG::where('internalkey', $request->internalkey)
                ->update([
                    'status'    =>  'B' //BUSY
                ]);

        return back();
    }

    public function message(Request $request){

        MSGLOG::create([
            'internalkey'   =>  $request->internalkey,
            'txndate'       =>  date('Y-m-d'),
            'txntime'       =>  date('H:i:s'),
            'remarks'       =>  $request->remarks,
            'userid'        =>  Auth::user()->empno
        ]);
        
        return back();
    }

    public function tix_number(Request $request){

        $tixNum =   TIXNUM::where('TaskNumber', $request->tixnum)->exists();

        if(!$tixNum){
            Session::flash('error', 'Ticket number does not exists!');
            return back();
        }

        // $retVal =   exec('java CheckPowerForm ' . $request->tixnum);

        // $num    =   substr($retVal, 10);

        // if($num == "false"){
        //     Session::flash('error', 'Ticket number does not exists!');
        //     return back();
        // }
        // else{
            MSGLOG::create([
                'internalkey'   =>  $request->internalkey,
                'txndate'       =>  date('Y-m-d'),
                'txntime'       =>  date('H:i:s'),
                'remarks'       =>  $request->tixnum,
                'userid'        =>  Auth::user()->empno
            ]);
            
            RECVMSG::where('internalkey', $request->internalkey)
                    ->update([
                        'status'    =>  'C' //COMPLETED
                    ]);
    
            return back();
        // }
    }

}
