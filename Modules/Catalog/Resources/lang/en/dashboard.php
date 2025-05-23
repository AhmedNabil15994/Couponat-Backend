<?php

return [
    'academicyears'        => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            'title'         => 'Title',
        ],
        'form'      => [
            'title'             => 'Title',
            'status'            => 'Status',
            'restore'            => 'Restore',
            'tabs'              => [
                'general'           => 'General Info.',
            ],
        ],
        'routes'    => [
            'create'    => 'Create',
            'index'     => 'Academic years',
            'update'    => 'Update',
        ],
        'validation'=> [
            'title'         => [
                'required'  => 'Please enter the title',
                'unique'    => 'This title is taken before',
            ],
        ],
    ],
];
