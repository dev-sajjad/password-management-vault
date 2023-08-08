<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Protected route to get all records (logins, cards, and identifies) for the authenticated user
    public function userRecords(Request $request)
    {
        $user = auth()->user();
        $logins = $user->logins()->where('name', 'LIKE', '%' . $request->search . '%')->get();
        $cards = $user->cards()->where('name', 'LIKE', '%' . $request->search . '%')->get();
        $identities = $user->identities()->where('name', 'LIKE', '%' . $request->search . '%')->get();

        return response()->json([
            'logins' => $logins,
            'cards' => $cards,
            'identities' => $identities,
        ]);
    }



    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);
       
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 403);
        }

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $apiToken = Str::random(80);
        $user->api_token = $apiToken;
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User registered successfully'
        ], 200);
    }

    // User login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $apiToken = Str::random(80);
        $user->api_token = $apiToken;
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User successfully logged in.'
        ], 200);
    }


}
