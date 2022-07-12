<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
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
            'nama_kelas' => ['required','min:2','regex:/^[a-zA-Z0-9 ]*$/u'],
            'level_id' => 'required' 
        ];
    }

    public function messages()
    {
        return [
            'nama_kelas.regex' => 'Nama kelas tidak boleh terdapat simbol',
            'nama_kelas.min' => 'Nama harus memiliki minimal 2 karakter',
            'nama_kelas.required' => 'Nama belum diisi'
        ];
    }
}
