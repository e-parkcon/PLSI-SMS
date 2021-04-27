@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><small>Failed Messages Dashboard</small></h5>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width=75%>Message</th>
                                <th>Key</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($failedSms as $fsms)
                                <tr>
                                    <td>{{ $fsms->fmsg }}</td>
                                    <td>{{ $fsms->internalKey }}</td>
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