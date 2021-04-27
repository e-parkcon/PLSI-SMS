<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RECVMSG;
use App\MSGLOG;
use App\TIXNUM;
use App\OTHERSMS;
use App\FAILEDSMS;

use DB;
use Auth;
use Session;
use Response;

class FailedMessages extends Controller
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

    public function view_failedsms(){

        $failed_sms =   FAILEDSMS::get();

        return view('failed_messages.failed-sms')->with('failedSms', $failed_sms);
    }
}
