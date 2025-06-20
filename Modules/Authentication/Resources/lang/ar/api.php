<?php

return [
    'forget_password'   => [
        'mail'      => [
            'subject'   => 'تعين كلمة مرور جديدة',
        ],
        'messages'  => [
            'success'   => 'تم ارسال تعين كلمة المرور الجديدة بنجاح عبر البريد الالكتروني',
        ],
    ],
    'login'             => [
        'validation'    => [
            'email'     => [
                'email'     => 'من فضلك ادخل البريد بشكل صحيح',
                'required'  => 'من فضلك ادخل البريد الالكتروني',
            ],
            'failed'    => 'هذه البيانات غير متطابقة لدينا من فضلك تآكد من بيانات تسجيل الدخول',
            'password'  => [
                'min'       => 'كلمة المرور يجب ان تكون اكثر من ٦ مدخلات',
                'required'  => 'يجب ان تدخل كلمة المرور',
            ],
        ],
    ],
    'logout'            => [
        'messages'  => [
            'failed'    => 'فشلت عملية تسجيل الخروج',
            'success'   => 'تم تسجيل الخروج بنجاح',
        ],
    ],
    'password'          => [
        'messages'      => [
            'sent'  => 'تم ارسال بريد بتعين كلمة مرور جديدة',
        ],
        'validation'    => [
            'email' => [
                'email'     => 'من فضلك ادخل البريد بشكل صحيح',
                'exists'    => 'هذا البريد غير موجود لدينا',
                'required'  => 'من فضلك ادخل البريد الالكتروني',
            ],
        ],
    ],
    'complete_register'          => [
        'messages'      => [
            'failed'    => 'فشلت عمليه تسجيل الدخول ، حاول مره اخرى',
        ],
    ],
    'register'          => [
        'messages'      => [
            'failed'    => 'فشلت عملية تسجيل الدخول ، حاول مره اخرى',
            "error_sms" => "خطا فى ارسال الرساله يرجى المحاوله  فى وقت اخر",
            "error_sms_mobile"=> "خطا فى ارسال الرساله الى الجوال المدخل  يرجى التاكد من الجوال مكتوب بشكل صحيح" ,
            "code_verifed_not_correct" => "كود التاكيد غير صحيح",
            "code_send" => "كود التفعيل الخاص بك هو: :code ",
            "code"      => " كود التاكيد غير صحيح" ,
        ],
        'validation'    => [
            'email'     => [
                'email'     => 'من فضلك ادخل البريد بشكل صحيح',
                'required'  => 'من فضلك ادخل البريد الالكتروني',
                'unique'    => 'هذا البريد الالكتروني تم حجزة من قبل شخص اخر',
            ],
            'mobile'    => [
                'digits_between'    => 'يجب ان يتكون رقم الهاتف من ٨ ارقام',
                'numeric'           => 'من فضلك ادخل رقم الهاتف من ارقام انجليزية فقط',
                'required'          => 'من فضلك ادخل رقم الهاتف',
                'unique'            => 'رقم الهاتف تم حجزه من قبل شخص اخر',
            ],
            'name'      => [
                'required'  => 'من فضلك ادخل الاسم الشخصي',
            ],
            'password'  => [
                'confirmed' => 'كلمة المرور غير متطابقة مع التآكيد',
                'min'       => 'كلمة المرور يجب ان تتكون من اكثر من ٦ مدخلات',
                'required'  => 'يجب ان تدخل كلمة المرور',
            ],
            'title'     => [
                'category_id'   => 'اختر الخدمات المتاحة للشركة',
                'required'      => 'من فضلك ادخل اسم. الشركة',
            ],
        ],
    ],
    'reset'             => [
        'mail'          => [
            'button_content'    => 'تعين كلمة مرور جديدة',
            'header'            => 'انت تستقبل هذا البريد الالكتروني لآنك قمت بطلب تعين كلمة مرور جديدة لفقدانك القديمة',
            'subject'           => 'تعين كلمة مرور جديدة',
        ],
        'title'         => 'تعين كلمة مرور جديدة',
        'validation'    => [
            'email'     => [
                'email'     => 'من فضلك ادخل البريد بشكل صحيح',
                'exists'    => 'هذا البريد غير موجود لدينا',
                'required'  => 'من فضلك ادخل البريد الالكتروني',
            ],
            'password'  => [
                'min'       => 'كلمة المرور يجب ان تتكون من اكثر من ٦ مدخلات',
                'required'  => 'يجب ان تدخل كلمة المرور',
            ],
            'token'     => [
                'exists'    => 'انتهت صلاحية هذا الطلب',
                'required'  => 'لا تملك صلاحية تعين كلمة مرور جديدة قم بعمل طلب جديد',
            ],
        ],
    ],

    'after-register' => [
        'mail' => [
            'header' =>
            'انت تستقبل هذا البريد الالكتروني لآنك قمت بعمل حساب لدي  :app_name
             <br>     :email:  البريد الالكتروني
             <br>     :password: الرقم السري
            ',
        ]
    ],
    'workers'           => [],
];
