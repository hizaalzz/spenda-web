<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class PelaksanaanRequest extends FormRequest
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
                    'sesi_id' => 'required|numeric',
                    'murid_id' => 'required',
                    'ruangan_id' => 'required|numeric',
                    'jadwal_id' => 'required|numeric'
                ];
            }

            case 'PUT': {
                return [
                    'sesi_id' => 'required|numeric',
                    'ruangan_id' => 'required|numeric'
                ];
            }
        }
        
    }

    public function messages()
    {
        return [
            'murid_id.unique' => 'Data pelaksanaan sudah ada',
            'murid_id.required' => 'Murid belum dipilih',
            'ruangan.required' => 'Ruangan belum dipilih'
        ];
    }
}
