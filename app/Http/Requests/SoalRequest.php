<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoalRequest extends FormRequest
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
                    'jenis' => 'required|numeric|in:1,2',
                    'paket_id' => 'required',
                    'bank_soal_id' => 'required',
                    'isi' => 'required',
                    'kunci_jawaban' => 'nullable',
                    'audio' => 'nullable|mimes:mp3,amr,wav'        
                ];
            }

            case 'PUT': {
                return [
                    'paket_id' => 'required',
                    'bank_soal_id' => 'required',
                    'isi' => 'required',
                    'kunci_jawaban' => 'nullable',
                    'audio' => 'nullable|mimes:mp3,amr,wav'        
                ];
            }
        }
        
    }

    public function messages()
    {
        return [
            'jenis.in' => 'Jenis soal tidak valid',
            'jenis.required' => 'Jenis soal belum dipilih',
            'paket_id.required' => 'Paket soal belum dipilih',
            'bank_soal_id.required' => 'Bank soal belum dipilih',
            'isi.required' => 'Isi soal belum diisi',
            'pilA.required' => 'Pilihan A belum diisi',
            'pilB.required' => 'Pilihan B belum diisi',
            'kunci_jawaban.required' => 'Kunci jawaban belum dipilih',
            'kunci_jawaban.in' => 'Kunci jawaban tidak valid',
            'jenis.required' => 'Jenis belum dipilih'
        ];
    }
}
