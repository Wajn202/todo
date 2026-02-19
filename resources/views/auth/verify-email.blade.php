@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="auth-box">
    <h3> Verify Email </h3>

    @if($errors->any())
        <div class="error-box">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('verify.code') }}">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        <input type="text" name="code" placeholder="Enter Four-digit code" maxlength="4" required>
        <button type="submit"> Verify </button>
    </form>
</div>
{{-- Timer --}}
    <p style="margin-top:15px;">
        you didn't receive the code?
        <span id="timer" style="color:blue;">60</span> Sec
    </p>

    {{-- Resend --}}
    <form method="POST" action="{{ route('resend.code') }}">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">

        <button type="submit"
                id="resendBtn"
                disabled
                style="margin-top:10px;">
            Resend the code 
        </button>
    </form>

</div>

<script>
let time = 60;
let timer = document.getElementById('timer');
let resendBtn = document.getElementById('resendBtn');

let countdown = setInterval(() => {
    time--;
    timer.innerText = time;

    if (time <= 0) {
        clearInterval(countdown);
        timer.innerText = '0';
        resendBtn.disabled = false;
        resendBtn.style.color = 'green';
    }
}, 1000);
</script>
@endsection 