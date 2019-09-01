@extends('layouts_admin.master')

@section('css')
<style>
    .circle-text {
        width: 60px;
        padding: 10px;
    }

    .circle-text:after {
        content: "";
        display: block;
        width: 100%;
        height: 0;
        padding-bottom: 100%;
        background: #4679BD;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }

    .circle-text div {
        float: left;
        width: 100%;
        padding-top: 50%;
        line-height: 1em;
        margin-top: -0.5em;
        text-align: center;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">Verify One Time Password</div>
    <div class="card-body">

        <form action="{{route('admin.TOTP.check')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="totpNameInput">TOTP</label>
                <input name="totp" type="text" class="form-control" id="totpNameInput">
            </div>

            <div class="row">
                <div class="col-auto align-self-center">
                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                </div>

                <div id="timeDiv" class="circle-text col-auto">
                    <div id="time">60</div>
                </div>
            </div>
        </form>

        <form class="mt-2" action="{{route('admin.TOTP.resend')}}" method="POST">
            @csrf
            <button id="resendButton" type="submit" class="btn btn-md btn-secondary">Resend</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const button = document.getElementById("resendButton");
    const time = document.getElementById("time");
    const timeDiv = document.getElementById("timeDiv");
    let remainingTime = 60;

    const interval = setInterval(() => {
        if (remainingTime !== 0) {
            time.innerHTML = --remainingTime;
        } else {
            timeDiv.remove();
            clearInterval(interval);
        }
    }, 1000);
</script>
@endsection
