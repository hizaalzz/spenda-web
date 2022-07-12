<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Purifier;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');    
    }

    public function index() 
    {
        return view('pages.settings');
    }
    
    public function saveOrUpdate(Request $request)
    {
        $this->validate($request, [
            'tata_tertib' => 'required',
            'sambutan' => 'nullable|max:100'
        ]);

        $tata_tertib = Purifier::clean($request->tata_tertib, array('HTML.Allowed' => 
            'div,b,strong,i,em,u,ul,ol,li,p[style],br,span[style]'));

        DB::table('settings')->updateOrInsert(
            ['key' => 'tata_tertib'],
                ['content' => $tata_tertib]
        );

        if(isset($request->sambutan)) {
            DB::table('settings')->updateOrInsert(
                ['key' => 'sambutan'],
                ['content' => $request->sambutan]
            );
        } else {
            DB::table('settings')->where('key', '=', 'sambutan')->delete();
        }

        return redirect()->route('settings')->with('success', 'Berhasil mengupdate setelan');
    
    }
}
