<?php

namespace App\Http\Controllers;

use App\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AppUserAuthController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {

        $validation_array = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:app_users',
            'password' => 'required|string|min:8|confirmed'
        ];

        $validator = Validator::make($request->all(), $validation_array);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'false',
                'message' => 'INVALID REQUEST',
                'data' => [
                    'errors' => $validator->errors()
                ]
            ], 200);
        }

        $user = new AppUser();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success' => 'true',
            'message' => 'USER CREATED'
        ], 201);

    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

}
