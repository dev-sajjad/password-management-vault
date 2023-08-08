<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    //protected route to get the authenticated user's own card records
    public function userCards()
    {
        $user = auth()->user();
        $cards = $user->cards;
        return response()->json($cards);
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), Card::$rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = auth()->user();

        $card = new Card([
            'name' => $request->input('name'),
            'holder_name' => $request->input('holder_name'),
            'brand' => $request->input('brand'),
            'number' => $request->input('number'),
            'exp_month' => $request->input('exp_month'),
            'exp_year' => $request->input('exp_year'),
            'notes' => $request->input('notes')
        ]);

        $user->cards()->save($card);

        return response()->json([
            'success' => true,
            'data' => $card,
            'message' => 'Card record created successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Card::$rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = auth()->user();

        $card = $user->cards()->find($id);

        if (!$card) {
            return response()->json(['error' => 'Card record not found'], 404);
        }

        $card->update([
            'name' => $request->input('name'),
            'holder_name' => $request->input('holder_name'),
            'brand' => $request->input('brand'),
            'number' => $request->input('number'),
            'exp_month' => $request->input('exp_month'),
            'exp_year' => $request->input('exp_year'),
            'notes' => $request->input('notes')
        ]);

        return response()->json([
            'success' => true,
            'data' => $card,
            'message' => 'Card record updated successfully'

        ]);
    }


    public function destroy($id)
    {
        $user = auth()->user();
        $card = $user->cards()->find($id);

        if (!$card) {
            return response()->json(['error' => 'Card record not found']);
        }

        $card->delete();

        return response()->json([
            'success' => true,
            'data' => $card,
            'message' => 'Card record successfully deleted'
        ]);
    }

}   
