<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\{ PasswordResetRequest, PasswordUpdateRequest };
use App\Notifications\{ PasswordResetRequestNotification, PasswordResetSuccessNotification };
use App\Models\{ User, PasswordReset };
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function forgotPasswordPage()
    {
        return view('front.auth.forgot-password');
    }

    /**
     * forgot-password
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request)
    {        
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['success'=>false, 'message' => 'The user for this email does not exist.']);
        }

        $token = app('auth.password.broker')->createToken($user);
        
        Mail::send('emails.password', ['token' => $token, 'email' => $email], function ($message) use ($user, $email) {
            $message->to($email)->subject('Reset Password');
        });
        return response()->json(['success'=>true, 'message' => 'The email was sent. Please check your email box']);
    }

    public function resetPasswordPage($token, $email)
    {
        return view('front.auth.reset-password')->with(
            ['token' => $token, 'email' => $email]
        );
    }
    /**
     * reset password
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            return response()->json(['success'=>false,'error' => 'The user for this email does not exist.']);
        }

        $token = \DB::table('password_resets')
            ->where('email', $user->email)
            ->first();

        if (!$token) {
            return response()->json(['success'=>false, 'message'=>'We can not find a user with that email address.']);
        }

        $user->password = bcrypt($request->get('password'));
        $user->save();

        \DB::table('password_resets')->where('email', $token->email)->delete();

        return response()->json(['success'=>true, 'message'=>'Your password has been reset.']);
    }
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(PasswordResetRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'success'=>false,
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
            ]
        );
        if ($user && $passwordReset) {
            $user->notify(new PasswordResetRequestNotification($user, $passwordReset->token));
        }

        return response()->json([
            'success'=>true,
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }

     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(PasswordUpdateRequest $request)
    {
        $passwordReset = PasswordReset::where([
            ['token', $request->token]
        ])->first();
        if (!$passwordReset) {
            return response()->json([
                'message' => 'We can not recognize your request.'
            ], 404);
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccessNotification($user));

        return redirect('/dashboard');
    }
}
