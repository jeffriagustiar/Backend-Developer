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
                // 'password' => $request->password,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
             return 'bisa';
        } catch (Exception $e) {
            return 'gagal';
        }

        
        
    }
}
