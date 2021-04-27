<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RECVMSG;
use App\MSGLOG;
use App\TIXNUM;
use App\OTHERSMS;

use DB;
use Auth;
use Session;
use Response;


class OtherMessages extends Controller
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

    public function other_sms_dashboard(){

        $other_sms  =   OTHERSMS::orderBy('recvdate', 'desc')
                                ->orderBy('recvtime', 'desc')
                                ->get();

        return view('other_messages.other-sms')->with('other_sms', $other_sms);
    }

}
