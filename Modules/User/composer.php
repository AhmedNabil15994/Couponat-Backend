<?php

// Dashboard ViewComposr
view()->composer([
    'company::dashboard.companies.*',
    'order::dashboard.reports.*',
    'order::vendor.reports.*',
], \Modules\User\ViewComposers\Dashboard\UserComposer::class);
