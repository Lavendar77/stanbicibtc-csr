<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentForm extends Component
{
    public $action;
    public $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $user)
    {
        $this->action = $action;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.student-form');
    }
}
