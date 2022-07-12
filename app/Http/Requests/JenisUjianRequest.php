<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisUjianRequest extends FormRequest
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
            'nama' => 'required|min:3|unique:jenis_ujian'
        ];
    }

    public function messages()
    {
        return [
            'nama.min' => 'Nama jenis ujian harus memiliki minimal 3 karakter',
            'nama.unique' => 'Nama jenis ujian tidak boleh sama'
        ];
    }
}
