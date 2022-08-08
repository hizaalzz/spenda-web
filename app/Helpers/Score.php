<?php 

namespace App\Helpers;

use App\Models\Jawaban;

//perhitungan soal
class Score {
    static $jenisSoal = [
        'pilihanganda' => 1,
        'essay' => 2
    ];


    public static function hitungPilihanGanda($pilihanGanda, $mode = 'otomatis') {
        $PGBenar = [];
        $PGSalah = [];

        switch($mode) {
            case 'otomatis': {
                foreach($pilihanGanda as $pilihan) {
                    if($pilihan->jawaban == $pilihan->soal->kunci_jawaban) {
                        $pilihan->status = 'Benar';

                        $pilihan->save();

                        array_push($PGBenar, $pilihan);
                    } else {
                        $pilihan->status = 'Salah';

                        $pilihan->save();

                        array_push($PGBenar, $pilihan);
                    }
                }
            }

            case 'manual': {
                $PGBenar = $pilihanGanda->filter(function($item) {
                    return $item->status == 'Benar';
                });

                $PGSalah = $pilihanGanda->filter(function($item) {
                    return $item->status == 'Salah';
                });
            }
        }

        return ['Benar' => $PGBenar, 'Salah' => $PGSalah];
    }

    public static function count($answer, $jadwal, $mode = 'otomatis') 
    {

        $soalPilihanGanda = $jadwal->banksoal->soal->filter(function($item) {
            return $item->jenis == self::$jenisSoal['pilihanganda'];
        });

        $pilihanGanda = $answer->filter(function($item) {
            return $item->soal->jenis == self::$jenisSoal['pilihanganda'];
        });

        $hitungPilihanGanda = Self::hitungPilihanGanda($pilihanGanda, $mode);

        $PGBenar = $hitungPilihanGanda['Benar'];
        $PGSalah = $hitungPilihanGanda['Salah'];

        // Menghitung score PG yang didapat

        $maksimalScore = count($soalPilihanGanda) * 1;
        $scoreDidapat = count($PGBenar) * 1;

        $scorePilihanGanda = ($scoreDidapat / $maksimalScore) * $jadwal->penilaian->bobot_pg;


        // Essay 

        $soalEssay =  $jadwal->banksoal->soal->filter(function($item) {
            return $item->jenis == self::$jenisSoal['essay'];
        });


        $essay = $answer->filter(function($item) {
            return $item->soal->jenis == self::$jenisSoal['essay'];
        });

        if(!count($soalEssay)) return $scorePilihanGanda;

        // Mendapatkan jawaban benar

        $essayBenar = $essay->filter(function($item) {
            return $item->status == 'Benar';
        });


        // Mendapatkan jawaban salah

        $essaySalah = $essay->filter(function($item) {
            return $item->status != 'Benar';
        });

        // Menyimpan jawaban essay salah dan benar

        Self::saveStatus($essayBenar, 'Benar');
        Self::saveStatus($essaySalah, 'Salah');

        // Menghitung score essay yang didapat

        $maksimalScoreEssay = count($soalEssay) * 3;

        // Walaupun jawaban essay salah, score diberi 1
        $scoreEssaySalah = count($essaySalah) * 1;
        $scoreEssayDidapat = count($essayBenar) * 3 + $scoreEssaySalah;

        $scoreEssay = ($scoreEssayDidapat / $maksimalScoreEssay) * $jadwal->penilaian->bobot_essay;

        return $scorePilihanGanda + $scoreEssay;
    }

    public static function saveStatus($data, $status) {
        foreach($data as $jawaban) {
            $jawaban->status = $status;

            $jawaban->save();
        }
    }
}