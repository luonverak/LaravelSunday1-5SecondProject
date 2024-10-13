<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            // if (!$request->has("email") || $request->email == null) {
            //     return response()->json([
            //         "status" => "failed",
            //         "msg" => "Email name is requried"
            //     ]);
            // }

            // if (!$request->has("password") || $request->password == null) {
            //     return response()->json([
            //         "status" => "failed",
            //         "msg" => "Password name is requried"
            //     ]);
            // }

            $email = $request->email;
            $password = $request->password;

            $credentials = $request->only(["email", "password"]);

            if (!Auth::attempt($credentials)) {
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
            } else {
                if($user->tokens()->exists()){
                    $user->tokens()->delete();
                }
                $token = $user->createToken("USER_TOKEN")->plainTextToken;
                $cookie = cookie("jwt", $token, 1);
                return response()->json([
                    "status" => "success",
                    "msg" => "Account login success",
                    "user" => $user,
                    "token" => $token
                ])->withCookie($cookie);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
