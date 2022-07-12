<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\BobotRule;
use App\Rules\DateNotConflictRule;

class JadwalRequest extends FormRequest
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
                    'nama' => ['required','max:50','min:2','regex:/^[a-zA-Z0-9 ]*$/u'],
                    'tanggal' => 'required|date',
                    'kelas_id' => ['required', new DateNotConflictRule($this->tanggal)], 
                    'matapelajaran_id' => 'required',
                    'guru_id' => 'required',
                    'bobot_pg' => ['nullable', 'numeric', new BobotRule($this->bobot_essay)],
                    'bobot_essay' => ['nullable', 'numeric', new BobotRule($this->bobot_pg)],
                    'bank_soal_id' => 'nullable|numeric',
                    'jenisujian_id' => 'required|numeric',
                    'tanggal_expire' => 'required|date_format:H:i'
                ];
            }

            case 'PUT': {
                return [
                    'nama' => ['required','max:50','min:2','regex:/^[a-zA-Z0-9 ]*$/u'],
                    'tanggal' => 'required|date',
                    'kelas_id' => ['required', new DateNotConflictRule($this->tanggal, $this->route('jadwal'))], 
                    'matapelajaran_id' => 'required',
                    'guru_id' => 'required',
                    'bobot_pg' => ['nullable', 'numeric', new BobotRule($this->bobot_essay)],
                    'bobot_essay' => ['nullable', 'numeric', new BobotRule($this->bobot_pg)],
                    'bank_soal_id' => 'nullable|numeric',
                    'jenisujian_id' => 'required|numeric',
                    'tanggal_expire' => 'required|date_format:H:i'                
                ];
            }
        }
        
    }

    public function messages()
    {
        return [
            'nama.regex' => 'Nama jadwal tidak boleh mengandung simbol',
            'tanggal_expire.after_or_equal' => 'Tanggal expire harus lebih besar atau sama dengan tanggal mulai',
        ];
    }
}
