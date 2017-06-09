<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ValidToken
{
    /**
     * Check if the provided token is valid or not.
     */
    public function handle($request, Closure $next)
    {
        try {
            // attempt to verify user
            if( ! $currentUser = JWTAuth::parseToken()->authenticate() ) {
                return response()->json([ 'error' => 'invalid_token' ], 400 );
            }
        } catch ( JWTException $e ) {
            // failed to generate the token
            return response()->json( [ 'error' => 'unable_to_verify_token' ], 500 );
        }
        // return response()->json($currentUser);
        $payload = JWTAuth::parseToken()->getPayload();
        // Check if we have any organization with the request.
        // if( $payload->get('organization') == false ) {

        //     /**
        //     * IMPORTANT - IMPORTANT - IMPORTANT
        //     * Check if the current user has permission on the organization.
        //     * IMPORTANT - IMPORTANT - IMPORTANT
        //     **/

        //     return response()->json( [ 'error' => 'invalid_organization' ], 500 );
        // }
        
        // Add decoded user with request.
        // $currentUser->id           = $payload->get( 'id' );
        // // $currentUser->organization = $payload->get( 'organization' );
        $request->currentUser = $currentUser;
        $request->attributes->add( [ 'currentUser' => $currentUser ] );
        return $next($request);
    }
}
