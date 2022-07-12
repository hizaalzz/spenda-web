<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\SesiRule;

class SesiRequest extends FormRequest
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
                    'nama' => ['required','unique:sesi','regex:/^[a-zA-Z0-9 ]*$/u'],
                    'start' => ['required', new SesiRule('past', $this->end)],
                    'end' => ['required', new SesiRule('future', $this->start)]
                ];
            }
            case 'PUT': {
                return [
                    'nama' => ['required','regex:/^[a-zA-Z0-9 ]*$/u'],
                    'start' => ['required', new SesiRule('past', $this->end)],
                    'end' => ['required', new SesiRule('future', $this->start)]
                ];
            }
        }
       
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama belum diisi',
            'nama.unique' => 'Nama sesi tidak boleh sama',
            'nama.regex' => 'Nama sesi tidak boleh terdapat simbol'
        ];
    }
}
