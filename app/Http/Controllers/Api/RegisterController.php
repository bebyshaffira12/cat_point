<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validation rules for registration
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required',
            'no_hp'     => 'required',
            'alamat'     => 'required',
        ]);

        // Return validation error response
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create a new user
        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role'    => $request->input('role'),
            'no_hp'    => $request->input('no_hp'),
            'alamat'    => $request->input('alamat'),
        ]);

        // You can customize the response based on your requirements
        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'user'    => $user->only(['name', 'email', 'role']),
        ], 201);
    }
}
