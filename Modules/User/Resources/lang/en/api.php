<?php

return [
    'users' => [
        'updated'   => 'Data has been updated successfully!!',
        'validation'    => [
            'current_password'  => [
                'required'  => 'Current password is required',
            ],
            'email'             => [
                'required'  => 'Please enter the email of user',
                'unique'    => 'This email is taken before',
            ],
            'mobile'            => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of user',
                'unique'            => 'This mobile is taken before',
            ],
            'name'              => [
                'required'  => 'Please enter the name of user',
            ],
            'captcha'              => [
                'required'  => 'Please enter captcha',
                'captcha'  => 'Please check captcha entered , try again !',
            ],
            'password'          => [
                'min'       => 'Password must be more than 8 characters',
                'required'  => 'Please enter the password of user',
                'same'      => 'The Password confirmation not matching',
            ],
        ],
    ],
];
