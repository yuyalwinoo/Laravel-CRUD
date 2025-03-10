<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => ['required','string','email','max:255'],
            'password' =>'required'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
    
        $validatedData = $validator->validated();
        
        $token = null;
        $user = User::where('email', $validatedData['email'])->firstOrFail();
        
        if($user && Hash::check($validatedData['password'], $user->password)) {
            $token = $user->createToken('user')->plainTextToken;
            $user->remember_token = $token;
            $user->save();
            session(['api_token' => $token]);
            return redirect()->route('posts.index')->with('token', $token);
        }else{
            return redirect()->route('auth.login')->withErrors(['errors' => 'Provide a valid user.']);
        }
        
    }

    public function logout(Request $request)
    {
        if ($request->user()->tokens()->delete()) {
            session()->forget('api_token');
            return view('auth.login');
        }
    }
}
