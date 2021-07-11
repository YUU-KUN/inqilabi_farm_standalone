<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Register;
use App\Http\Requests\ProfileCompletion;
use App\Http\Requests\Login;
use App\Models\User;
use App\Models\Kurban;
use Hash, Auth;

class UserController extends Controller
{
    public function getAllUser(Request $request)
    {
        return User::all();
    }

    public function profile(Request $request) {
        $user = User::find(Auth::guard('api')->user()->id);
        return response()->json([
            'user' => $user,
            'message' => 'Berhasil mendapatkan data pengguna',
            'status' => 1,
        ]);
    }

    public function register(Register $request) {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['level'] = 'user';

        if (!$input['isAgree']) {
            return 'Mohon setujui syarat dan ketentuan';
        }
        $user = User::create($input);
        if (!$user) {
            return 'Terdapat kesalahan';
        }
        return response()->json([
            'data' => $user,
            'message' => 'Pendaftaran berhasil',
        ]);
    }

    public function login(Login $request) {
        $input = $request->all();
        $user = User::where('email', $input['emailOrPhone'])->orWhere('phone', $input['emailOrPhone'])->first();
        if (!isset($user)) {
            return 'User tidak ditemukan';
        };
        if (!Hash::check($input['password'], $user->password)) {
            return 'Password salah';
        }
        $user->access_token = $user->createToken('User')->accessToken;

        return response()->json([
            'user' =>  $user,
            'status' => 1,
            'message' =>  'Selamat datang, '.$user->name,
        ]);
    }

    public function profileCompletion(ProfileCompletion $request) {
        $input = $request->all();
        $user = Auth::guard('api')->user();
        $user->update($input);
        return $user;
    }

    public function logout() {
        Auth::logout();
        return 'Berhasil Logout';
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        return 'Berhasil menghapus data User';
    }
}
