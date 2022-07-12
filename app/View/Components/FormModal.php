<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $formName;
    public $modalName;

    public function __construct($formName, $modalName)
    {
        $this->formName = $formName;
        $this->modalName = $modalName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-modal');
    }
}
