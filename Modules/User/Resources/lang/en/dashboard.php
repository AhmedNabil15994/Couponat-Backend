<?php

return [
    'item_not_found' => "Sorry, this offer is not listed under your company offers",
    'admins'            => [
        'create'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'info'              => 'Info.',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                'roles'             => 'Roles',
                'delete_reason'     => 'Delete Reason',
            ],
            'title' => 'Create Admins',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            'image'         => 'Image',
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'options'       => 'Options',
        ],
        'index'     => [
            'title' => 'Admins',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Change Password',
                'roles'             => 'Roles',
            ],
            'title' => 'Update Admins',
        ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of admin',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of admin',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of admin',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of admin',
                'same'      => 'The Password confirmation not matching',
            ],
            'roles'     => [
                'required'  => 'Please select the role of admin',
            ],
        ],
    ],
    'sellers'            => [
        'create'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'info'              => 'Info.',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                'roles'             => 'Roles',
            ],
            'title' => 'Create Sellers',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            'image'         => 'Image',
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'options'       => 'Options',
        ],
        'index'     => [
            'title' => 'Sellers',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Change Password',
                'roles'             => 'Roles',
            ],
            'title' => 'Update Sellers',
        ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of seller',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of admin',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of seller',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of seller',
                'same'      => 'The Password confirmation not matching',
            ],
            'roles'     => [
                'required'  => 'Please select the role of seller',
            ],
        ],
    ],
    'employees'            => [
        'create'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'info'              => 'Info.',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                'roles'             => 'Roles',
            ],
            'title' => 'Create Employees',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            'image'         => 'Image',
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'options'       => 'Options',
        ],
        'index'     => [
            'title' => 'Employees',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Change Password',
                'roles'             => 'Roles',
            ],
            'title' => 'Update Employees',
        ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of employee',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of employee',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of employee',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of employee',
                'same'      => 'The Password confirmation not matching',
            ],
            'roles'     => [
                'required'  => 'Please select the role of employee',
            ],
        ],
    ],
    'medical_profiles'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            'image'         => 'Image',
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'options'       => 'Options',
            'prfoile'       => 'Review',
            'profile'       => 'Review',
        ],
        'form'      => [
            'is_reviewed'   => 'Is Reviewed ?',
        ],
        'index'     => [
            'title' => 'Medical Profiles',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General info.',
                'image'             => 'Profile Image',
                'medical_profile'   => 'Medical Profile',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Change Password',
            ],
            'title' => 'Update Medical Profile',
        ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of user',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of user',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of user',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of user',
                'same'      => 'The Password confirmation not matching',
            ],
        ],
    ],
    'users'             => [
        'create'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'info'              => 'Info.',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                'expired_at'        => 'Expired At',
                'expired'           => 'Expired',
                'code'              => 'Code',
                'offer'             => ':offer',
            ],
            'title' => 'Create Users',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            'image'         => 'Image',
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'is_verified'   => 'Phone Verified',
            'verified'   => 'Verified',
            'not_verified'   => 'Not Verified',
            'options'       => 'Options',
        ],
        'index'     => [
            'title' => 'Users',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Change Password',
            ],
            'title' => 'Update User',
        ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of user',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of user',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of user',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of user',
                'same'      => 'The Password confirmation not matching',
            ],
        ],
    ],
    'redeemed_before'   => 'Offer has been redeemed before',
    'redeemed' =>  'Offer has been redeemed successfully',
    'redeem' => 'Redeem',
];
