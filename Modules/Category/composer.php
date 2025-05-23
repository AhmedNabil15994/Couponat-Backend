<?php

// Dashboard ViewComposr
view()->composer([
    'category::dashboard.categories.*',
    'category::vendor.categories.*',
    'offer::dashboard.offers.*',
    'offer::vendor.offers.*',
    'apps::frontend.*',
], \Modules\Category\ViewComposers\Dashboard\CategoryComposer::class);
view()->composer([
    'apps::frontend.*',
], \Modules\Category\ViewComposers\Frontend\CategoryComposer::class);
