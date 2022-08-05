<?php

namespace App\Rules;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateNotConflictRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $tanggal;
    public $jadwal;

    public function __construct($tanggal, $jadwal = null)
    {
        $this->tanggal = $tanggal;
        $this->jadwal = $jadwal;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $jadwal = Jadwal::where('kelas_id', $value)->get();

        $now = Carbon::parse($this->tanggal);
        
        if($jadwal !== null) 
        {
            foreach($jadwal as $item)
            {
                if($this->jadwal !== null) 
                {
                    if($this->jadwal->id === $item->id) continue;
                }

                $start = Carbon::parse($item->tanggal);
                $end = Carbon::parse($item->tanggal_expire);

                if($now->between($start, $end)) return false;
            }

        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Jadwal di jam tersebut sudah ada.';
    }
}
