<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaketRequest extends FormRequest
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
            'kode_soal' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'kode_soal.required' => 'Kode soal belum diisi'
        ];
    }
}
