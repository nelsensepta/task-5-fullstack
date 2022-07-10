<?php

namespace Modules\V1\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return response(["status" => 200, "meesage" => "Berhasil Membuat Akun", "user" => $user]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return response(["status" => 400, "message" => "Email / Password Salah"]);
        }

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken($user->name)->accessToken;
            return response(["status" => 200, "meesage" => "Berhasil Login", "user" => $user, "token" => $token]);
        } else {
            return response(["status" => 400, "message" => "Email / Password Salah"]);
        }

    }
}