<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankSoalRequest extends FormRequest
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
            'level_id' => 'required|numeric',
            'matapelajaran_id' => 'required|numeric',
            'guru_id' => 'required|numeric',
            'jurusan_id' => 'required|numeric',
            'opsi_pg' => 'required|in:1,2,3,4,5',
            'status' => 'required|in:Aktif,Nonaktif'
        ];
    }
}
