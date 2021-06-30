<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileCompletion extends FormRequest
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
            'alamat' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ];
    }

    public function messages() {
        return [
            'alamat.required' => 'Mohon lengkapi alamat anda',
            'kecamatan.required' => 'Mohon lengkapi kecamatan anda',
            'kota.required' => 'Mohon lengkapi kota anda',
            'provinsi.required' => 'Mohon lengkapi provinsi anda',
        ];
    }
}
