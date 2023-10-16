<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListarFollowers extends Component
{
    public $users;
    public function __construct($users)
    {
        $this->users=$users;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.listar-followers');
    }
}
