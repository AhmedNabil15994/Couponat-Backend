<?php

namespace Modules\Area\ViewComposers\Dashboard;

use Modules\Area\Repositories\Dashboard\StateRepository as State;
use Illuminate\View\View;
use Cache;

class StateComposer
{
    public $states = [];

    public function __construct(State $state)
    {
        $this->states =  $state->getAll();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('states' , $this->states);
    }
}
