<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'password' => 'required'
        ],[
            'nis.required' => 'Nis belum diisi',
            'password.required' => 'password belum diisi'
        ]);

        if($validator->fails()) {
            $response = [
                'status' => 'error',
                'message' => 'Validasi error',
                'errors' => $validator->errors(),
                'content' => null
            ];
            
            return response()->json($response, 400);
        }

        $credentials = $request->only(['nis', 'password']);

        if(Auth::attempt($credentials)) {
            $user = User::where('nis', $request->nis)->first();

            $token = $user->createToken('auth_token')->plainTextToken;

            $response = [
                'status' => 'success',
                'message' => 'Login successfully',
                'errors' => null,
                'content' => [
                    'status_code' => 200,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            ];

            return response()->json($response,200);
        }

        $response = [
            'status' => 'error',
            'message' => 'Unathorized',
            'errors' => null,
            'content' => null,
        ];

        return response()->json($response, 401);
    }

    public function logout(Request $request) 
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        $response = [
            'status' => 'success',
            'message' => 'Logout successfully',
            'errors' => null,
            'content' => null,
            
        ];

        return response()->json($response, 200);
    }

    public function logoutAll(Request $request) 
    {
        $user = $request->user();

        $user->tokens()->delete();

        $response = [
            'status' => 'success',
            'message' => 'Logout successfully',
            'errors' => null,
            'content' => null,
            
        ];

        return response()->json($response, 200);
    }
}
