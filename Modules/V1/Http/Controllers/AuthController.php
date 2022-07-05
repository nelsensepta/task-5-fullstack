<?php

namespace Modules\V1\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        try {
            $user = User::where("email", $request->email)->first();
            if (!$user) {
                return response(["status" => 400, "message" => "User Not Found"]);
            }

            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken($user->name)->accessToken;
                return response()->json(["status" => 200, "message" => "Berhasil Login", "token" => $token]);
            } else {
                return response(["status" => 400, "message" => "Email / Password Salah"]);
            }

        } catch (\Exception$e) {
            return response(["message" => $e->getMessage(), "status" => 400]);
        }
    }
}