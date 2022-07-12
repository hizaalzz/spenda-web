<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengumumanRequest extends FormRequest
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
            'judul' => ['required','min:5','regex:/^[a-zA-Z0-9 ]*$/u'],
            'konten' => ['required', 'not_regex:/<(?:\/?script>|\?php)|\?>/'],
            'jenis' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul belum diisi',
            'judul.min' => 'Judul harus memiliki minimal 5 karakter',
            'judul.regex' => 'Judul tidak boleh terdapat simbol',
            'konten.required' => 'Konten belum diisi',
            'konten.not_regex' => 'Konten tidak valid',
            'jenis.required' => 'Jenis belum dipilih'
        ];
    }
}
