<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdentityController extends Controller
{
    // protected route to get the authenticated user's own identity records
    public function userIdentities()
    {
        $user = auth()->user();
        $identities = $user->identities;
        
        return response()->json($identities);
    }




    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), Identity::$rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = auth()->user();

        $identity = new Identity([
            'name' => $request->input('name'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'company' => $request->input('company'),
            'passport_number' => $request->input('passport_number'),
            'license_number' => $request->input('license_number'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'notes' => $request->input('notes')
        ]);

        $user->identities()->save($identity);

        return response()->json([
            'success' => true,
            'data' => $identity,
            'message' => 'Identity record created successfully'
        ]);
    }




    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Identity::$rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = auth()->user();

        $identity = $user->identities()->find($id);

        if (!$identity) {
            return response()->json(['error' => 'Identity record not found'], 404);
        }

        $identity->update([
            'name' => $request->input('name'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'company' => $request->input('company'),
            'passport_number' => $request->input('passport_number'),
            'license_number' => $request->input('license_number'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'notes' => $request->input('notes')
        ]);

        return response()->json([
            'success' => true,
            'data' => $identity,
            'message' => 'Identity record updated successfully'
        ]);

    }





    public function destroy($id)
    {
        $user = auth()->user();
        $identity = $user->identities()->find($id);

        if (!$identity) {
            return response()->json(['error' => 'Identity record not found']);
        }

        $identity->delete();

        return response()->json([
            'success' => true,
            'data' => $identity,
            'message' => 'Identity record successfully deleted'
        ]);
    }


}
