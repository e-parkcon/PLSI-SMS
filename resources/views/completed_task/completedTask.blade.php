@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><small>Completed Task Dashboard</small></h5>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-hover" id="tbl_parent">
                        <thead>
                            <tr>
                                <th width=25%>Message</th>
                                <th width=35%>Received Date</th>
                                <th width=15% class="text-left">Assisted by</th>
                                <th width=5%></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complTask as $comp)
                                <tr id="tbl_child" internalkey="{{ $comp['internalkey'] }}">
                                    <td title="{{$comp['text_message']}}">
                                        {{ strlen($comp['text_message']) > 35 ? substr($comp['text_message'], 0, 80)."..." : $comp['text_message'] }}
                                        <br>
                                        <span class="badge badge-success">Date Sent: {{ date('M. d, Y', strtotime($comp['sentdate'])) }}, {{ date('h:i:s A', strtotime($comp['senttime'])) }}</span>
                                    </td>
                                    <td>{{ date('F d, Y', strtotime($comp['recvdate'])) }}, {{ date('h:i:s A', strtotime($comp['recvtime'])) }}</td>
                                    <td>
                                        {{ $comp['name'] }}
                                        <br>
                                        <span class="text-danger">Response Time: {{ $comp['responseTime'] }}</span>
                                    </td>
                                    <td>
                                        <a href="#" id="msglog"><span class="fa fa-info-circle"></span></a>
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

<script src="{{ asset('js/completed-task.js') }}"></script>
@endsection