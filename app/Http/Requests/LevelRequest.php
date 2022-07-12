<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LevelRequest extends FormRequest
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
            'nama' => ['required','min:2','regex:/^[a-zA-Z0-9 ]*$/u'],
            'skala' => ['required', 'in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15']
        ];
    }

    public function messages()
    {
        return [
            'nama.min' => 'Nama harus memiliki minimal 2 karakter',
            'nama.required' => 'Nama belum diisi',
            'nama.regex' => 'Nama level tidak boleh terdapat simbol.',
            'skala.in' => 'Skala hanya diperbolehkan menggunakan angka 1-15',
            'skala.required' => 'Skala belum dipilih'
        ];
    }
}
