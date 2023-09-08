<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Section ;

class Sections extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $sections;
    public function __construct()
    {
        $this->sections = Section::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sections');
    }
}
