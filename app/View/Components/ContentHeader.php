<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContentHeader extends Component
{
    public $title;
    public $module;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $module)
    {
        $this->title = $title;
        $this->module = $module;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.content-header');
    }
}
