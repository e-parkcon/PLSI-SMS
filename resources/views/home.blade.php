@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Home</h5>
                </div>
                <div class="card-body" id="test">

                    <h5>You are logged in!</h5>

                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/sms.js') }}"></script>
@endsection
