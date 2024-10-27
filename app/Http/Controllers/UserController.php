<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function register(Request $request)
    {
        try {
            if (!$request->has("first_name") || $request->first_name == null) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "First name is requried"
                ]);
            }
            if (!$request->has("last_name") || $request->last_name == null) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Last name is requried"
                ]);
            }
            if (!$request->has("email") || $request->email == null) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Email name is requried"
                ]);
            }

            if (!$request->has("password") || $request->password == null) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Password name is requried"
                ]);
            }

            $firstName = $request->first_name;
            $lastName = $request->last_name;
            $email = $request->email;
            $password = $request->password;

            $user = new User();
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->email = $email;
            $user->password = $password;
            $user->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function login(Request $request)
    {
        try {
            $email = $request->email;
            $password = $request->password;

            $credentials = $request->only(["email", "password"]);

            if (! $token = Auth::attempt($credentials)) {
                return response()->json(
                    [
                        "status" => "failed",
                        "msg" => "Something wrong login failed"
                    ],
                    Response::HTTP_UNAUTHORIZED
                );
            }

            $user = User::where("email", $email)->first();
            if (!$user) {
                return response()->json(
                    [
                        "status" => "failed",
                        "msg" => "Something wrong"
                    ],
                );
            }

            if (!Hash::check($password, $user->getAuthPassword())) {
                return response()->json(
                    [
                        "status" => "failed",
                        "msg" => "Something wrong"
                    ],
                );
            }

            $token = bin2hex(openssl_random_pseudo_bytes(20));
            $userToken = new UserToken();
            $userToken->token = $token;
            $userToken->user_id = $user->id;
            $userToken->save();

            return response()->json([
                "status" => "success",
                "msg" => "Account login success",
                "user" => Auth::user(),
                "token" => $token
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
