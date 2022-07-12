<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JurusanRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST': {
                return [
                    'kode_tingkat' => ['required','unique:jurusan','regex:/^[a-zA-Z0-9 ]*$/u'],
                    'nama' => 'required|min:2'
                ];
            }
            case 'PUT': {
                return [
                    'kode_tingkat' => 'required',
                    'nama' => 'required|min:2'
                ];
            }
        }
        
    }

    public function messages()
    {
        return [
            'kode_tingkat.unique' => 'Kode jurusan sudah digunakan.',
            'kode_tingkat.regex' => 'Kode jurusan tidak boleh terdapat simbol.',
            'nama.min' => 'Nama harus memiliki minimal 2 karakter',
            'nama.required' => 'Nama belum diisi'
        ];
    }
}
