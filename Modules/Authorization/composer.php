<?php

use Modules\Authorization\ViewComposers\Dashboard\AdminRolesComposer;
use Modules\Authorization\ViewComposers\Dashboard\SellerRolesComposer;

view()->composer([
    'user::dashboard.admins.index',
], AdminRolesComposer::class);
view()->composer([
    'user::dashboard.sellers.index',
], SellerRolesComposer::class);


view()->composer([
    'user::dashboard.employees.index',
], SellerRolesComposer::class);
