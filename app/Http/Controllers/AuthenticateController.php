<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{
    //
    public function authenticate( Request $request )
    {
        // get user inputs
        $userInputs = $request->only( 'email', 'password' );
        // return response()->json($userInputs);
        try {
            // attempt to verify user and create a token
            if( ! $token = JWTAuth::attempt( $userInputs ) ) {
                return response()->json([ 'error' => 'invalid_user_credentials' ], 400 );
            }
        } catch ( JWTException $e ) {
            // failed to generate the token
            return response()->json( [ 'error' => 'unable_to_create_token' ], 500 );
        }
        // valid user was found, return a token
        return response()->json( [ 'token' => $token ] );
    }
}
