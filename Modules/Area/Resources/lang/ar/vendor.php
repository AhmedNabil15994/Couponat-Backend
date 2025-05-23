<?php

return [
    'areas'     => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'options'       => 'الخيارات',
            'state'         => 'المدينة',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'form'      => [
            'cities'    => 'المحافظة',
            'state'     => 'اختر المدينة',
            'status'    => 'الحالة',
            'tabs'      => [
                'general'   => 'بيانات عامة',
            ],
            'title'     => 'العنوان',
        ],
        'routes'    => [
            'create'    => 'اضافة المنطقة',
            'index'     => 'المنطقة',
            'update'    => 'تعديل المنطقة',
        ],
        'validation'=> [
            'city_id'   => [
                'required'  => 'من فضلك اختر المدينة',
            ],
            'title'     => [
                'required'  => 'من فضلك ادخل العنوان',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
    'cities'    => [
        'datatable' => [
            'countries' => 'الدولة',
            'created_at'=> 'تاريخ الآنشاء',
            'options'   => 'الخيارات',
            'status'    => 'الحالة',
            'title'     => 'العنوان',
        ],
        'form'      => [
            'countries' => 'اختر الدولة',
            'status'    => 'الحالة',
            'tabs'      => [
                'general'   => 'بيانات عامة',
            ],
            'title'     => 'العنوان',
        ],
        'routes'    => [
            'create'    => 'اضافة المحافظات',
            'index'     => 'المحافظات',
            'update'    => 'تعديل المحافظة',
        ],
        'validation'=> [
            'country_id'    => [
                'required'  => 'من فضلك اختر الدولة',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل العنوان',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
    'countries' => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'form'      => [
            'status'    => 'الحالة',
            'tabs'      => [
                'general'   => 'بيانات عامة',
            ],
            'title'     => 'العنوان',
        ],
        'routes'    => [
            'create'    => 'اضافة الدول',
            'index'     => 'الدول',
            'update'    => 'تعديل الدولة',
        ],
        'validation'=> [
            'title' => [
                'required'  => 'من فضلك ادخل العنوان',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
    'states'    => [
        'datatable' => [
            'cities'        => 'المحافظة',
            'created_at'    => 'تاريخ الآنشاء',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'form'      => [
            'cities'    => 'اختر المحافظة',
            'status'    => 'الحالة',
            'tabs'      => [
                'general'   => 'بيانات عامة',
            ],
            'title'     => 'العنوان',
        ],
        'routes'    => [
            'create'    => 'اضافة المدينة',
            'index'     => 'المدينة',
            'update'    => 'تعديل المدينة',
        ],
        'validation'=> [
            'city_id'   => [
                'required'  => 'من فضلك اختر المحافظة',
            ],
            'title'     => [
                'required'  => 'من فضلك ادخل العنوان',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
];
