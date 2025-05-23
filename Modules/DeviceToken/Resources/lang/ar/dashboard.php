<?php

return [
    'device_tokens' => [
        'routes'    => [
            'index'     => 'الأجهزة',
        ],
        'datatable' => [
            'title' => 'العنوان',
            'action' => 'الإجراء',
            'model' => 'نوع الإجراء',
            'user' => 'متخذ الإجراء',
            'created_at' => 'تاريخ إتخاذ الإجراء',
            'options' => 'الخيارات',
            'id' => 'الرقم',
            'name' => 'الإسم',
            'device_name' => 'إسم الجهاز',
            'user_name' => 'إسم المستخدم',
            'os' => 'نظام التشغيل',
            'last_used' => 'أخر ظهور',
        ],
        'activities' => [
            'actions' => [
                'created' => ' إضافة ',
                'updated' => ' تعديل ',
                'deleted' => ' حذف ',
            ],
            'helper_words' => [
                'unknown_user' => ' غير معروف ',
                'head_title' => ' قام ',
                'the' => ' ',
                'with_id' => ' برقم #',
            ]
        ],
    ],
    'devices' => [
        'message' => [
            'not_defined' => 'غير معروف',
        ]
    ],
];
