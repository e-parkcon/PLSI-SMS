<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RECVMSG;
use App\MSGLOG;
use App\User;

use DB;
use Auth;
use Session;
use Response;

class CompletedTask extends Controller
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
 
    public function completed_task(){

        $complTask  =   RECVMSG::where('status', 'C')->orderby('recvdate', 'desc')
                                                    ->orderby('recvtime', 'desc')->get();
        
        $task_completed = [];
        $x  =   0;
        foreach($complTask as $comp){

            $msglog =   MSGLOG::where('internalkey', $comp->internalkey)->get();

            $recv = strtotime($comp->recvdate. " " . $comp->recvtime);
            $calltime = strtotime($msglog->first()->txndate. " " . $msglog->first()->txntime);

            $diff = abs($calltime - $recv);  

            // To get the year divide the resultant date into total seconds in a year (365*60*60*24) 
            $years = floor($diff / (365*60*60*24));  
            // To get the month, subtract it with years and divide the resultant date into total seconds in a month (30*60*60*24) 
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
            // To get the day, subtract it with years and  months and divide the resultant date into total seconds in a days (60*60*24) 
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
            // To get the hour, subtract it with years,  months & seconds and divide the resultant date into total seconds in a hours (60*60) 
            $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));  
            // To get the minutes, subtract it with years, months, seconds and hours and divide the  resultant date into total seconds i.e. 60 
            $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60)/ 60);  
            // To get the minutes, subtract it with years, months, seconds, hours and minutes 
            $seconds = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));  

            $task_completed[$x]['internalkey']  =   $comp->internalkey;
            $task_completed[$x]['sentdate']     =   $comp->sentdate;
            $task_completed[$x]['senttime']     =   $comp->senttime;
            $task_completed[$x]['recvdate']     =   $comp->recvdate;
            $task_completed[$x]['recvtime']     =   $comp->recvtime;
            $task_completed[$x]['text_message'] =   $comp->text_message;
            $task_completed[$x]['telnum']       =   $comp->telnum;
            $task_completed[$x]['status']       =   $comp->status;

            if(count($msglog) == 0){
                $task_completed[$x]['userid']   =   '';
                $task_completed[$x]['name']     =   '';
                $task_completed[$x]['responseTime']     =   '';
            }
            else{
                $task_completed[$x]['userid']   =   $msglog->first()->userid;
                $task_completed[$x]['name']     =   User::where('empno', $msglog->first()->userid)->first()->fname . ' ' . User::where('empno', $msglog->first()->userid)->first()->lname;
                $task_completed[$x]['responseTime']     =  $days ." days, ". $hours .":". $minutes .":". $seconds;
            }

            $x++;
        }

        // dd($task_completed);
        return view('completed_task.completedTask')->with('complTask', $task_completed);
    }


    public function json_msglog(Request $request){

        $msglog =   MSGLOG::where('internalkey', $request->internalkey)->get();

        return Response::json($msglog);
    }

}
