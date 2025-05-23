<?php

return [
    'invalid_order' => "This Order is invalid or doesn't belong to you.",
    'orders'    => [
        'celebrities'   => [
            'mail'  => [
                'from'          => 'From',
                'header'        => 'You have a new video request',
                'instructions'  => 'Instructions',
                'is_gift'       => 'Is Gift',
                'is_hidden'     => 'Hidden',
                'is_not_gift'   => 'Personaly',
                'is_not_hidden' => 'Not hidden',
                'mobile'        => 'Mobile',
                'occasion'      => 'Occasion',
                'subject'       => 'You have a new request',
                'to'            => 'To',
                'total'         => 'Order Price',
            ],
        ],
        'client'        => [
            'mail'  => [
                'btn'           => 'Show the video from here now',
                'email'         => 'Email',
                'from'          => 'From',
                'header'        => 'Response of your request is done',
                'instructions'  => 'Instructions',
                'is_gift'       => 'Is Gift',
                'is_hidden'     => 'Hidden',
                'is_not_gift'   => 'Personaly',
                'is_not_hidden' => 'Not hidden',
                'mobile'        => 'Mobile',
                'occasion'      => 'Occasion',
                'subject'       => 'Response of your request',
                'to'            => 'To',
                'total'         => 'Order Price',
            ],
        ],
        'validations'   => [
            'availability'  => [
                'not_available' => 'Doctor not available in your selection, please change date or time.',
            ],
            'celebrity'     => [
                'not_available' => 'Sorry this celebrity busy , can not receive the request',
            ],
            'celebrity_id'  => [
                'required'  => 'Please select the celebrities id',
            ],
            'date'          => [
                'required'  => 'Please select the date',
            ],
            'doctor_id'     => [
                'required'  => 'Select doctor',
            ],
            'email'         => [
                'required'  => 'Please fill the email input',
            ],
            'instructions'  => [
                'required'  => 'Please fill the instructions',
            ],
            'max'           => [
                'required'  => 'The maximum file size allowed for videos 10 MB',
            ],
            'mimes'         => [
                'required'  => 'You should upload the video extinction with mp4',
            ],
            'mobile'        => [
                'required'  => 'Please fill the mobile input',
            ],
            'name'          => [
                'required'  => 'Please fill the name input',
            ],
            'occasion_id'   => [
                'required'  => 'Please select the occasion',
            ],
            'service_id'    => [
                'required'  => 'Select service',
            ],
            'time_from'     => [
                'required'  => 'Select time from',
            ],
            'time_to'       => [
                'required'  => 'Select time from',
            ],
            'to'            => [
                'required'  => 'please fill the name input',
            ],
            'video'         => [
                'required'  => 'Please upload your video',
            ],
            'worker_id'     => [
                'required'  => 'Select worker id',
            ],
        ],
        'workers'       => [
            'mail'  => [
                'from'          => 'From',
                'header'        => 'You have a new video request',
                'instructions'  => 'Instructions',
                'is_gift'       => 'Is Gift',
                'is_hidden'     => 'Hidden',
                'is_not_gift'   => 'Personaly',
                'is_not_hidden' => 'Not hidden',
                'mobile'        => 'Mobile',
                'occasion'      => 'Occasion',
                'subject'       => 'You have a new request',
                'to'            => 'To',
                'total'         => 'Order Price',
            ],
        ],
    ],
];
