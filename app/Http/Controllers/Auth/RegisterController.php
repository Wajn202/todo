<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        // لو الإيميل مسجل قبل
        if (User::where('email', $request->email)->exists()) {
            return redirect()
             ->route('login')
             ->withErrors(['email' => 'You already have an account, please login']);
        }

        $code = rand(1000, 9999);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => $code,
            'verification_expires_at' => now()->addMinute(),
        ]);

        Mail::raw("Your verification code is: $code", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Email Verification');
        });

        return redirect()->route('verify.page')->with('email', $request->email);
    }

    public function verifyPage()
    {
        return view('auth.verify-email');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:4',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Invalid code']);
        }
        // نحذف أي مسافات + نحولهم لنفس النوع
        $inputCode = trim($request->code);
        $savedCode = trim((string) $user->verification_code);

        if(now()->greaterThan($user->verification_expires_at)){
           return back()->withErrors(['code'=>'Verification code expired']);
        }
        if ($inputCode !== $savedCode) {
            return back()->withErrors(['code' => 'Verification code is incorrect']);
        }

        

        $user->update([
            'verification_code' => null,
            'verification_expires_at' => null, 
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')
            ->with('success', 'Registration successful, please login');
    }

    public function resendCode(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
    ]);

    $user = User::where('email', $request->email)->firstOrFail();

    // توليد كود جديد
    $code = rand(1000, 9999);

    $user->verification_code = $code;
    $user->verification_expires_at = Carbon::now()->addMinute(); // دقيقة
    $user->save();

    // إرسال الإيميل
    Mail::raw("Your verification code is: $code", function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Email Verification Code');
    });

    return back()->with('resent', true);
    }
}
