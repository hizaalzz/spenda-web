<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatapelajaranRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'nama.regex' => 'Nama tidak boleh terdapat simbol.',
            'nama.min' => 'Nama harus memiliki minimal 2 karakter',
            'nama.required' => 'Nama belum diisi'
        ];
    }
}
