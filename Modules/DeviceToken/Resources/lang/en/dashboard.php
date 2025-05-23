<?php

return [
    'device_tokens' => [

        'routes'    => [
            'index'     => 'Devices',
        ],
        'datatable' => [
            'title' => 'Title',
            'action' => 'Action',
            'model' => 'Model',
            'user' => 'User',
            'created_at' => 'Created at',
            'options' => 'Options',
            'id' => 'ID',
            'name' => 'Name',
            'device_name' => 'Device name',
            'user_name' => 'User name',
            'os' => 'OS',
            'last_used' => 'Last Login',
        ],
        'activities' => [
            'actions' => [
                'created' => ' create ',
                'updated' => ' update ',
                'deleted' => ' delete ',
            ],
            'helper_words' => [
                'unknown_user' => ' Unknown user ',
                'head_title' => ' ',
                'the' => ' the ',
                'with_id' => ' with ID  #',
            ]
        ],
    ],
    'devices' => [
        'message' => [
            'not_defined' => 'Not Defined',
        ]
    ],
];
