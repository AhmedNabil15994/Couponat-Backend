<?php

namespace Modules\User\ViewComposers\Dashboard;

use Modules\User\Repositories\Dashboard\UserRepository as User;
use Illuminate\View\View;
use Cache;

class UserComposer
{
    public $users = [];
    public $comp_sellers = [];
    public $customers = [];
    public function __construct(User $user)
    {
        $this->users =  $user->getAll();
        $this->comp_sellers = $user->getSellers();
        $this->customers = $user->getCustomers();
    }

    public function compose(View $view)
    {
        $view->with('users' , $this->users);
        $view->with('comp_sellers' , $this->comp_sellers);
        $view->with('customers' , $this->customers);
    }
}
