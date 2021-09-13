<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistration;
use App\Http\Requests\UserLogin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    /**
     * @param UserLogin $request
     * @return JsonResponse
     */
    public function login(UserLogin $request): JsonResponse
    {

        $userData = User::where('email', $request['email'])->first();

        if ($userData) {
          $token = $userData->createToken(Str::random(128))->accessToken;
            if(!$userData->email_verified_at){
                return response()->json([
                    'message' => "Please finnish Registration, check your email",
                ], 404);
            }

            if(Hash::check($request->password, $userData->password)){
                return response()->json([
                    'data' => $userData,
                    'token' => $token,
                ], 200);
            }
        }
        return response()->json([
            'incorrect' => "Please fill correct data",
        ], 422);
    }

    /**
     * @return JsonResponse
     */
    public function current()
    {
        return response()->json(Auth()->user(), 200);
    }

    /**
     * @param UserRegistration $request
     * @return JsonResponse
     */
    public function register(UserRegistration $request)
    {
        $ver_token = Str::random(128);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verification_token' => $ver_token
        ]);

        $this->emailVerification($user, $ver_token);

        return response()->json([
            "message" => "User created"
        ], 200);
    }

    /**
     * @param $user
     * @param $token
     */
    public function emailVerification($user, $token){
        Mail::send('mail.verify', ['user' => $user, 'token' => $token], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Please Verify your Email');
        });
    }

    public function verify(Request $req)
    {
        $user = User::query()
            ->where('email', $req->get('email'))
            ->where('verification_token', $req->get('token'))
            ->first();

        if (Hash::check($req['password'], $user->password)) {
            $user->update([
                'verification_token' => null,
                'email_verified_at' => Carbon::now()->timestamp
            ]);
            return response()->json([
                'success' => true,
                'message' => 'User Successfully Verified'
            ],200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Verification Failed'
            ], 401);
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out'],200);
    }
}
