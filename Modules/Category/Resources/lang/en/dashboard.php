<?php

return [
    'categories'        => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'image'         => 'Image',
            'options'       => 'Options',
            'status'        => 'Status',
            'title'         => 'Title',
        ],
        'form'      => [
            'image'             => 'Image',
            'color'             => 'Color',
            'main_category'     => 'Main Category',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'Status',
            'banner'            => 'Website Banner',
            'mobile_banner'            => 'Mobile Banner',
            'restore'            => 'Restore',
            'sort'              => 'Order',
            'tabs'              => [
                'category_level'    => 'Categories Tree',
                'category_banner'   => 'Category Banner Data',
                'general'           => 'General Info.',
                'seo'               => 'SEO',
            ],
            'title'             => 'Title',
            'banner_status'     => 'Show Banner?',
            'start_at'          => 'Banner Start Date',
            'expired_at'        => 'Banner End Date',
            'banner_size'       => 'Banner Size ( % )',
        ],
        'routes'    => [
            'create'    => 'Create Categories',
            'index'     => 'Categories',
            'update'    => 'Update Category',
        ],
        'validation'=> [
            'category_id'   => [
                'required'  => 'Please select category level',
            ],
            'image'         => [
                'required'  => 'Please select image',
            ],
            'title'         => [
                'required'  => 'Please enter the title',
                'unique'    => 'This title is taken before',
            ],
        ],
    ],
];
