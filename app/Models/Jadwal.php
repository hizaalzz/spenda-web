<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Jadwal extends Model
{
    use LogsTrait;
    
    protected $table = 'jadwal';
    protected $fillable = ['tanggal', 'tanggal_expire', 'nama', 'kelas_id', 'guru_id', 'matapelajaran_id', 'bank_soal_id', 'kkm'];

    protected static $propertyLogsToShow = 'id';

    public function getTanggalAttribute($value) 
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function setTanggalAttribute($value) 
    {
        return $this->attributes['tanggal'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getTanggalExpireAttribute($value) 
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function setTanggalExpireAttribute($value) 
    {
        return $this->attributes['tanggal_expire'] = Carbon::parse($value)->format('H:i');
    }

    public function scopeGetActiveJadwal($query, $kelas = null) 
    {

        if(env('DB_CONNECTION') == 'pgsql') 
        {
            //For postgresql

            return $query->where('kelas_id', $kelas ?? auth()->user()->murid->kelas_id)
                ->where('tanggal', '>=', Carbon::now()->format('Y-m-d'))->orderBy(DB::raw("ABS(DATE_PART('day', tanggal::timestamp - NOW()::timestamp))"));
        }
        
        //For mysql
        return $query->where('kelas_id', $kelas ?? auth()->user()->murid->kelas_id)
            ->where('tanggal', '>=', Carbon::now()->format('Y-m-d'))->orderBy(DB::raw('ABS(DATEDIFF(tanggal, NOW()))'));

    }

    public function scopeGetNearestJadwal($query)
    {
        if(env('DB_CONNECTION') == 'pgsql') 
        {
            //For postgresql

            return $query->whereDate('tanggal', '>=', date('Y-m-d'))->orderBy(DB::raw("ABS(DATE_PART('day', tanggal::timestamp - NOW()::timestamp))"));
        }
        
        //For mysql
        return $query->whereDate('tanggal', '>=', date('Y-m-d'))->orderBy(DB::raw('ABS(DATEDIFF(tanggal, NOW()))'));
    }

    public function scopeWithAll($query) 
    {
        return $query->with([
            'guru' => function($query) {
                return $query->select('id', 'nama');
            }, 
            'kelas' => function($query) {
                return $query->select('id', 'nama_kelas');
            }, 
            'matapelajaran' => function($query) {
                return $query->select('id', 'nama');
            }, 
            'penilaian', 
            'jenisujian' => function($query) {
                return $query->select('id', 'nama');
            }
        ]);
    }

    public function scopeWithComplete($query) 
    {
        return $query->with(['guru', 'kelas', 'matapelajaran', 'banksoal']);
    }

    public function scopePassed($query) 
    {
        return $query->where('tanggal', '>=', Carbon::now()->format('Y-m-d'));
    }

    public function scopeWhereGuru($query, $value) 
    {
        return $query->where('guru_id', $value);
    }

    public function scopeExclude($query, $value = []) 
    {
        return $query->select(array_diff($this->columns, (array) $value));
    } 

    ///Relation 

    public function guru()
    {
        return $this->belongsTo('App\Models\Guru');
    }

    public function kelas() 
    {
        return $this->belongsTo('App\Models\Kelas');
    }

    public function matapelajaran() 
    {
        return $this->belongsTo('App\Models\Matapelajaran');
    }

    public function status()
    {
        return $this->hasMany('App\Models\Status');
    }

    public function pelaksanaan() 
    {
        return $this->hasMany('App\Models\Pelaksanaan');
    }

    public function banksoal() 
    {
        return $this->belongsTo('App\Models\BankSoal', 'bank_soal_id');
    }

    public function penilaian() 
    {
        return $this->hasOne('App\Models\Penilaian');
    }

    public function nilai() 
    {
        return $this->hasMany('App\Models\Nilai');
    }

    public function jenisujian() 
    {
        return $this->belongsTo('App\Models\JenisUjian');
    }
}
