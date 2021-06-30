<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Register;
use App\Http\Requests\ProfileCompletion;
use App\Http\Requests\Login;
use App\Models\Admin;
use Hash, Auth;

class AdminController extends Controller
{
    public function register(Register $request) {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        // if ($input['password_confirmation'] !== $input['password']) {
        //     return 'Konfirmasi password salah';
        // }
        if (!$input['isAgree']) {
            return 'Mohon setujui syarat dan ketentuan';
        }
        $admin = Admin::create($input);
        return $admin;
    }

    public function login(Login $request) {
        $input = $request->all();
        // $crecentials = $request->only(['email' => $input['email'], 'password' => $input['password']]);
        // if (Auth::guard('admin')->attempt($crecentials)) {}
        $admin = Admin::where('email', $input['emailOrPhone'])->orWhere('phone', $input['emailOrPhone'])->first();
        if (!isset($admin)) {
            return 'Admin tidak ditemukan. Silahkan cek email yang Anda masukkan atau buat akun terlebih dahulu';
        };
        if (!Hash::check($input['password'], $admin->password)) {
            return 'Password salah';
        }
        $admin->access_token = $admin->createToken('Admin')->accessToken;

        return response()->json([
            'admin' =>  $admin,
            'message' =>  'Selamat datang, '.$admin->name,
        ]);
    }

    public function profileCompletion(ProfileCompletion $request) {
        $input = $request->all();
        $admin = Admin::update($input);
        return $admin;
    }

    public function logout() {
        Auth::logout();
        return 'Berhasil Logout';
    }
}
