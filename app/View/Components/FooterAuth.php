<?php

namespace App\View\Components;

use Illuminate\View\Component;

use Carbon\Carbon;

class FooterAuth extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $year = Carbon::now()->format('Y');
        
        return view('components.footer-auth');
    }
}
