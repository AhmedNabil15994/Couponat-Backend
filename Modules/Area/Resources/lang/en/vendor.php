<?php

return [
    'areas'     => [
        'datatable' => [
            'created_at'    => 'Created at',
            'options'       => 'Options',
            'state'         => 'State',
            'status'        => 'Status',
            'title'         => 'Title',
        ],
        'form'      => [
            'cities'    => 'Select City',
            'state'     => 'Select State',
            'status'    => 'Status',
            'tabs'      => [
                'general'   => 'General Info.',
            ],
            'title'     => 'Title',
        ],
        'routes'    => [
            'create'    => 'Create Area',
            'index'     => 'Area',
            'update'    => 'Update State',
        ],
        'validation'=> [
            'city_id'   => [
                'required'  => 'Please Select state of this area',
            ],
            'title'     => [
                'required'  => 'Please add the title',
                'unique'    => 'This title is taken before',
            ],
        ],
    ],
    'cities'    => [
        'datatable' => [
            'countries' => 'Country',
            'created_at'=> 'Created At',
            'options'   => 'Options',
            'status'    => 'Status',
            'title'     => 'Title',
        ],
        'form'      => [
            'countries' => 'Select Country',
            'status'    => 'Status',
            'tabs'      => [
                'general'   => 'General Info.',
            ],
            'title'     => 'Title',
        ],
        'routes'    => [
            'create'    => 'Create Cities',
            'index'     => 'Cities',
            'update'    => 'Update City',
        ],
        'validation'=> [
            'country_id'    => [
                'required'  => 'Please select country of this city',
            ],
            'title'         => [
                'required'  => 'Please add the title of city',
                'unique'    => 'This title is taken before',
            ],
        ],
    ],
    'countries' => [
        'datatable' => [
            'created_at'    => 'Created at',
            'options'       => 'Options',
            'status'        => 'Status',
            'title'         => 'Title',
        ],
        'form'      => [
            'status'    => 'Status',
            'tabs'      => [
                'general'   => 'General Info.',
            ],
            'title'     => 'Title',
        ],
        'routes'    => [
            'create'    => 'Create Country',
            'index'     => 'Countries',
            'update'    => 'Update Country',
        ],
        'validation'=> [
            'title' => [
                'required'  => 'Please add title for this country',
                'unique'    => 'This title is taken before',
            ],
        ],
    ],
    'states'    => [
        'datatable' => [
            'cities'        => 'City',
            'created_at'    => 'Created at',
            'options'       => 'Options',
            'status'        => 'Status',
            'title'         => 'Title',
        ],
        'form'      => [
            'cities'    => 'Select City',
            'status'    => 'Status',
            'tabs'      => [
                'general'   => 'General Info.',
            ],
            'title'     => 'Title',
        ],
        'routes'    => [
            'create'    => 'Create States',
            'index'     => 'States',
            'update'    => 'Update State',
        ],
        'validation'=> [
            'city_id'   => [
                'required'  => 'Please Select city of this state',
            ],
            'title'     => [
                'required'  => 'Please add the title',
                'unique'    => 'This title is taken before',
            ],
        ],
    ],
];
