<?php

view()->composer(['setting::dashboard.index'], \Modules\Page\ViewComposers\Dashboard\PageComposer::class);
view()->composer(['apps::frontend.*'], \Modules\Page\ViewComposers\Frontend\PageComposer::class);
