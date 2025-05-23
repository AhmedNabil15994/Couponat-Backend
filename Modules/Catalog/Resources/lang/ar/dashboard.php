<?php

return [
    'academicyears'        => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'form'      => [
            'title'             => 'عنوان',
            'status'            => 'الحالة',
            'restore'            => 'إسترجاع',
            'tabs'              => [
                'general'           => 'بيانات عامة',
            ],
        ],
        'routes'    => [
            'create'    => 'اضافة ',
            'index'     => 'السنة الدراسية',
            'update'    => 'تعديل ',
        ],
        'validation'=> [
            'title'         => [
                'required'  => 'من فضلك ادخل العنوان',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
];
