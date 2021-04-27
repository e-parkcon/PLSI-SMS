@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><small>Received Messages Dashboard</small></h5>
                </div>
                <div class="card-body table-responsive p-0" id="test">
                    <div class="table-responsive">
                        <table class="table table-hover text-sm m-0">
                            <thead>
                                <tr>
                                    <!-- <th width=25%>Sent Date</th> -->
                                    <th width=25%>Message</th>
                                    <th width=25%>Received Date</th>
                                    <th width=5% class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($receive_msg as $recvmsg)
                                    <tr id="tbl_child" class="{{ $recvmsg->status == 'B' ? 'table-danger' : '' }}"
                                            internalkey="{{ $recvmsg->internalkey }}"
                                            telnum="{{ $recvmsg->telnum }}" 
                                            network="{{ $recvmsg->network }}"
                                            status="{{ $recvmsg->status }}"
                                            client="{{ $recvmsg->client }}">
                                        <!-- <td>{{ date('F d, Y', strtotime($recvmsg->sentdate)) }}, {{ date('h:i:s A', strtotime($recvmsg->senttime)) }}</td> -->
                                        <td>
                                            {{ $recvmsg->text_message }}
                                            <br>
                                            <span class="badge badge-success">Date Sent: {{ date('M. d, Y', strtotime($recvmsg->sentdate)) }}, {{ date('h:i:s A', strtotime($recvmsg->senttime)) }}</span>
                                        </td>
                                        <td>{{ date('F d, Y', strtotime($recvmsg->recvdate)) }}, {{ date('h:i:s A', strtotime($recvmsg->recvtime)) }}</td>
                                        <td class="text-center">
                                            @if($recvmsg->status == 'B')
                                                <a href="#" id="phone" class="text-danger"><span class="fa fa-phone"></span></a>
                                                @if($recvmsg->empno == Auth::user()->empno)
                                                    <a href="#" id="message" class="text-primary" disable><span class="fa fa-comments"></span></a>
                                                    <a href="#" id="ticket_num" class="text-danger" disable><span class="fa fa-ticket"></span></a>   
                                                @endif
                                            @else
                                                <a href="#" id="phone" class="text-success"><span class="fa fa-phone"></span></a>
                                                <!-- <a href="#" id="message" class="text-primary"><span class="fa fa-comments"></span></a>
                                            <a href="#" id="ticket_num" class="text-danger"><span class="fa fa-ticket"></span></a> -->
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/sms.js') }}"></script>
@endsection