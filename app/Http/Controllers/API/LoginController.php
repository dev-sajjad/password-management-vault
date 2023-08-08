<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // protected route to get the authenticated user's own login records
    public function userLogins()
    {
        $user = auth()->user();
        $logins = $user->logins;

        return response()->json($logins);
    }



   public function create(Request $request)
   {
        $validator = Validator::make($request->all(), Login::$rules);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $user = auth()->user();
        $login = new Login([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'url' => $request->input('url'),
            'notes' => $request->input('notes')
        ]);

        $user->logins()->save($login);

        return response()->json([
            'success' => true,
            'data' => $login,
            'message' => 'Login record created successfully'
        ]);
   }




   public function update(Request $request, $id)
   {
        $validator = Validator::make($request->all(), Login::$rules);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = auth()->user();
        $logins = $user->logins()->find($id);

        if(!$logins) {
            return response()->json(['error' => 'Login record not found'], 404);
        }

        $logins->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'url' => $request->input('url'),
            'notes' => $request->input('notes')
        ]);

        return response()->json([
            'success' => true,
            'data' => $logins,
            'message' => 'Login record updated successfully'

        ]);
   }




   public function destroy($id)
   {
        $user = auth()->user();
        $login = $user->logins()->find($id);
        
        if(!$login) {
            return response()->json(['error' => 'Login record not found']);
        }

        $login->delete();

        return response()->json([
            'success' => true,
            'data' => $login,
            'message' => 'Login record successfully deleted'
        ]);
   }

}
