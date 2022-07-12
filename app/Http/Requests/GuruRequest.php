<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\DateRule;

class GuruRequest extends FormRequest
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
        switch($this->method()) 
        {
            case 'POST': {
                return [
                    'nama' => ['required','regex:/^[a-zA-Z0-9 ]*$/u','min:3'],
                    'email' => 'required|email|unique:admins',
                    'nuptk' => 'required|unique:guru',
                    'jenis_kelamin' => 'required|in:L,P',
                    'tanggal_lahir' => ['date_format:Y-m-d', new DateRule],
                    'telp' => 'nullable|min:11|max:12',
                    'fotoguru' => 'nullable|image',
                    'password' => 'confirmed|min:6|nullable',
                    'password_confirmation' => 'nullable'
                ];
            }

            case 'PUT': {
                return [
                    'nama' => ['required','regex:/^[a-zA-Z0-9 ]*$/u','min:3'],
                    'email' => 'required',
                    'jenis_kelamin' => 'required|in:L,P',
                    'tanggal_lahir' => ['date_format:Y-m-d', new DateRule],
                    'telp' => 'nullable|min:11|max:12',
                    'fotoguru' => 'nullable|image'

                ];
            }

            default: break;
        }
    }

    public function messages()
    {
        return [
            'nama.min' => 'Nama harus memiliki minimal 2 karakter',
            'nama.required' => 'Nama belum diisi',
            'nama.regex' => 'Nama guru tidak boleh terdapat simbol',
            'email.unique' => 'Email sudah digunakan',
            'nuptk.unique' => 'NUPTK tidak boleh sama',
            'fotoguru.image' => 'File foto tidak valid. foto harus berupa file gambar',
            'password.confirmed' => 'Konfirmasi password tidak sama'
        ];
    }
}
