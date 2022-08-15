<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\DateRule;

class MuridRequest extends FormRequest
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
                    'nis' => 'required|unique:users',
                    'nisn' => 'required|unique:murid',
                    'jenis_kelamin' => 'required|in:L,P',
                    'tanggal_lahir' => ['date_format:Y-m-d', new DateRule],
                    'telp' => 'nullable|min:11|max:12',
                    'fotomurid' => 'nullable|image',
                ];
            }

            case 'PUT': {
                return [
                    'nama' => ['required','min:3'],
                    'nis' => 'required',
                    'nisn' => 'required',
                    'jenis_kelamin' => 'required|in:L,P',
                    'tanggal_lahir' => ['date_format:Y-m-d', new DateRule],
                    'telp' => 'nullable|min:11|max:12',
                    'fotomurid' => 'nullable|image',
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
            'telp.min' => 'Nomor telepon harus memiliki minimal 11 karakter'
        ];
    }
}
