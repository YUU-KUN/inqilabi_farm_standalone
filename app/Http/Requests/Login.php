<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
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
            'emailOrPhone' => 'required',
            'password' => 'required',
        ];
    }

    public function messages() {
        return [
            'emailOrPhone.required' => 'Mohon isi email atau nomor telepon anda',
            'password.required' => 'Mohon isi password anda',
        ];
    }
}
