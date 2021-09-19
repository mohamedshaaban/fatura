<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationWelcome;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class AuthController extends Controller {

    use ResetsPasswords, SendsPasswordResetEmails;

    /**
     * Create user
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */

    public function register( Request $request )
    {
        $request->validate( [
            'username'       => 'required|string',
            'password'    => 'required|string',
            'role'    => 'required',
         ] );


        $user = User::create([
            'username'=>$request->username,
            'name'=>$request->username,
            'password'=>bcrypt($request->password)
        ]);

        $credentials = request( ['username', 'password'] );

        if ( Auth::attempt( $credentials ) )
        {
            $user = $request->user();
            $tokenResult = $user->createToken( 'Personal Access Token' );

            $token =$tokenResult->accessToken->token;


            return response()->json( [
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'expires_at'   => Carbon::parse(
                    $tokenResult->accessToken->expires_at
                )->toDateTimeString()
            ] );
        }

        return response()->json( [
            'message' => 'Your account is not exists yet!'
        ], 422 );

    }
    public function login( Request $request )
    {
        $request->validate( [
            'name'       => 'required|string',
            'password'    => 'required|string',
         ] );

        $credentials = request( ['username', 'password'] );
        if ( !Auth::attempt( $credentials ) )
        {
            return response()->json( [
                'message' => 'Unauthorized'
            ], 401 );
        }
        if ( Auth::attempt( $credentials )->user() )
        {
            $user = Auth::attempt( $credentials )->user();
            $tokenResult = $user->createToken( 'Personal Access Token' );
            $token = $tokenResult->token;



            $token->save();

            return response()->json( [
                'access_token' => $tokenResult->accessToken,
                'token_type'   => 'Bearer',
                'expires_at'   => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ] );
        }

        return response()->json( [
            'message' => 'Your account is not exists yet!'
        ], 422 );

    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout( Request $request )
    {
        $request->user()->token()->revoke();

        return response()->json( [
            'message' => 'Successfully logged out'
        ] );
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user( Request $request )
    {
        return response()->json( $request->user() );
    }

    /**
     * Send password reset link.
     */
    public function sendPasswordResetLink( Request $request )
    {
        session(['uemail'=>$request->email]);
        return $this->sendResetLinkEmail( $request );
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse( Request $request, $response )
    {
        return response()->json( [
            'message' => 'Password reset email sent.',
            'data'    => $response
        ] );
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkFailedResponse( Request $request, $response )
    {
        return response()->json( ['message' => 'Email could not be sent ... please check entered email again!'] );
    }

    /**
     * Handle reset password
     */
    public function callResetPassword( Request $request )
    {
        $attributes = $request->all();
        $email = '';
        $resets = DB::table( 'password_resets' )->get();
        foreach ($resets as $reset)
        {
            if ( Hash::check( $attributes['token'], $reset->token ) )
            {
                $email = $reset->email;
            }
        }

        if ( $email === '' )
        {
            return response()->json( ['error' => 'Invalid Token ... please request  another email!'] );
        }
        $request->request->add( ['email' => $email] );

        return $this->reset( $request );
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function credentials( Request $request )
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param string                                      $password
     * @return void
     */
    protected function resetPassword( $user, $password )
    {
//        dd($user);
        $user->password = Hash::make( $password );
        $user->save();
        event( new PasswordReset( $user ) );

    }

    protected function sendResetResponse( Request $request, $response )
    {
        return response()->json( ['success' => 'Password reset successfully.'] );
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse( Request $request, $response )
    {
        return response()->json( ['message' => 'Failed, Invalid Token.'] );

    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
