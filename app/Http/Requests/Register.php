<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|unique:users,phone|unique:admins,phone',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Mohon isi nama anda',
            'email.required' => 'Mohon lengkapi email anda',
            'email.email' => 'Format email salah',
            'email.unique' => 'Email sudah terpakai',
            'password.required' => 'Mohon lengkapi password anda',
            'password.min' => 'Password minimal terdiri dari 6 karakter',
            'password.confirmed' => 'Konfirmasi password salah',
            'phone.required' => 'Mohon lengkapi nomor telepon/wa anda',
            'phone.unique' => 'Nomor Telepon sudah terpakai',
        ];
    }
}
