@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><small>Other Messages Dashboard</small></h5>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <!-- <th width=25%>Sent Date</th> -->
                                <th width=25%>Message</th>
                                <th width=25%>Received Date</th>
                                <th width=15%>Tel. / Phone #</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($other_sms as $oth_sms)
                                <tr>
                                    <!-- <td>{{ date('F d, Y', strtotime($oth_sms->sentdate)) }}, {{ date('h:i:s A', strtotime($oth_sms->senttime)) }}</td> -->
                                    <td>
                                        {{ $oth_sms->text_message }}
                                        <br>
                                        <span class="badge badge-success">Date Sent: {{ date('M. d, Y', strtotime($oth_sms->sentdate)) }}, {{ date('h:i:s A', strtotime($oth_sms->senttime)) }}</span>
                                    </td>
                                    <td>{{ date('F d, Y', strtotime($oth_sms->recvdate)) }}, {{ date('h:i:s A', strtotime($oth_sms->recvtime)) }}</td>
                                    <td>{{ $oth_sms->telnum }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection