<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasswordGeneratorController extends Controller
{
    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uppercase' => 'boolean',
            'lowercase' => 'boolean',
            'specialChars' => 'boolean',
            'numbers' => 'boolean',
            'length' => 'integer|min:6|max:64',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Get the validated data
        $validatedData = $validator->validated();

        // Define character sets based on user options
        $characterSets = [];
        if ($validatedData['uppercase']) {
            $characterSets[] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($validatedData['lowercase']) {
            $characterSets[] = 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($validatedData['specialChars']) {
            $characterSets[] = '!@#$%^&*-_+=';
        }
        if ($validatedData['numbers']) {
            $characterSets[] = '0123456789';
        }

        if (empty($characterSets)) {
            return response()->json(['error' => 'Please select at least one option'], 400);
        }

        // Combine character sets and shuffle them
        $allCharacters = implode('', $characterSets);
        $shuffledCharacters = str_shuffle($allCharacters);

        // Generate the password
        $password = substr($shuffledCharacters, 0, $validatedData['length']);

        return response()->json(['password' => $password], 200);
    }
}
