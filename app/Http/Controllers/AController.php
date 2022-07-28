<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AController extends Controller
{
    public function regis(Request $request){

        try {
            $request->validate([
                'email' => ['required'],
                'password' => ['required'],
                'role' => ['required'],
            ]);
    
            User::create([
                'email' => $request->email,
                'password' => $request->password,
                // 'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
             return 'bisa';
        } catch (Exception $e) {
            return 'gagal';
        }

        
        
    }

    public function login(Request $request){

        try {
            $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);
    
            $a = User::where('email',$request->email)->where('password',$request->password)->first();
    
            $token = $a->createToken('authToken');
            return $token->plainTextToken;
    
            // return $a;
        } catch (Exception $e) {
            return 'cek email dan password';
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return 'logout';
    }
}
