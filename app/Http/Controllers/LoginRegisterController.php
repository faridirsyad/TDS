<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginRegisterController extends Controller
{
     public function register()
    {
        $data['title'] = 'Register';
        return view('auth/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::create($data);

        return redirect()->route('login')->with('success', 'Registration success. Please login!');
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view('auth/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/setting-country');
        }

        return back()->withErrors([
            'username' => 'Wrong username',
            'password' => 'Wrong password',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('auth/password', $data);
    }

    public function password_action(Request $request)
    {
        // $request->validate([
        //     'old_password' => 'required|current_password',
        //     'new_password' => 'required|confirmed',
        // ]);
        // $user = User::find(Auth::id());
        // $user->password = Hash::make($request->new_password);
        // $user->save();
        // $request->session()->regenerate();
        // return back()->with('success', 'Password changed!');
        $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('auth.link', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function reset_form($token) { 
        return view('auth.reset_form', ['token' => $token]);
    }

    public function reset(Request $request) { 
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string',
            'password_confirmation' => 'required|same:password'
        ]);
        
        $updatePassword = DB::table('password_resets')
        ->where([
                'email' => $request->email, 
                'token' => $request->token
        ])
        ->first();
   
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
   
        $dataUser  = array(
            'password'      => Hash::make($request->password),
            'updated_at'    => \Carbon\Carbon::now(),
		);
        $user = User::where('email', $request->email)
        ->update($dataUser);
  
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
   
        return redirect()->route('login')->with('success', 'Your password has been changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You are signed out!');
    }

}
