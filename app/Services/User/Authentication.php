<?php


namespace App\Services\User;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Authentication
{
    private $data;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function authenticateRequest()
    {
        $authMethod = $this->determineAuthMethod();

        switch ( $authMethod ) {
            case 'mobile':
                return $this->mobileAuthenticate();
            break;
            case 'sanctum':
                return $this->sanctumAuthenticate();
            break;
        }

        return null;
    }

    private function determineAuthMethod()
    {
        if ( isset( $this->data['device_name']) ) {
            return 'mobile';
        }
        return 'sanctum';
    }

    private function mobileAuthenticate()
    {
        $validator = Validator::make( $this->data, [
            'email'         => 'required|email',
            'password'      => 'required',
            'device_name'   => 'required'
        ]);

        if ( !$validator->fails() ) {
            // Grab the user that matched the email and check if the password match.
            $user = User::where('email', $this->data['email'] )->first();

            // If there is no user, or password incorrect return 403
            if (! $user || ! Hash::check( $this->data['password'], $user->password ) ) {
                return response()->json([
                    'error' => 'invalid_credentials'
                ], 403);
            }

            // Return the token for the user to the mobile app
            return [
                'token' => $user->createToken( $this->data['device_name'] )->plainTextToken
            ];
        }

        return response()->json([
            'error' => 'invalid_credentials',
            403
        ]);
    }

    private function sanctumAuthenticate()
    {
        $validator = Validator::make( $this->data, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if ( !$validator->fails() ) {
            // Attempt to log in user and if successful send a 204 response
            if ( Auth::attempt([
                'email'     => $this->data['email'],
                'password'  => $this->data['password']
            ])) {
                return response()->json('', 204);
            } else {
                return response()->json([
                    'error' => 'invalid_credentials'
                ], 403);
            }
        }

        return response()->json([
            'error' => 'invalid_credentials'
        ], 403);
    }
}
