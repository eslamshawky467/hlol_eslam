<?php

namespace App\View\Components;

use App\Models\Section;
use Illuminate\View\Component;

class ParentSections extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $parent_sections;
    public function __construct($id)
    {
        $this->parent_sections = Section::parent()->where('id', '!=', $id)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.parent-sections');
    }
}
