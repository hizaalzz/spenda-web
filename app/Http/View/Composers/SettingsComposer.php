<?php 

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SettingsComposer {

    public function compose(View $view) 
    {
        $sambutan = DB::table('settings')->where('key', '=', 'sambutan')->first();
        $tata_tertib = DB::table('settings')->where('key', '=', 'tata_tertib')->first();
        
        $view->with('sambutan', $sambutan->content ?? null);
        $view->with('tata_tertib', $tata_tertib->content ?? null);

    }
}