<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pengumuman;
use App\Http\Resources\PengumumanResource;

class RestPengumumanController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);

        return PengumumanResource::collection(Pengumuman::where('jenis', 'murid')
            ->orWhere('jenis', 'keduanya')
            ->simplePaginate($limit))->additional([
                'status' => 'success',
                'code' => 206
            ]
        );
    }

    public function show(Pengumuman $pengumuman)
    {
        return (new PengumumanResource($pengumuman))->additional(['status' => 'success']);
    }
}
