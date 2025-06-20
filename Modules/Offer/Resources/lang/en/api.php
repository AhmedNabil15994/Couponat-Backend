<?php

return [
    'invalid_offer' => 'This offer is invalid',
    'offers' => [
        'enter' => 'Enter Coupon',
        'checked_successfully' => 'Coupon has been added successfully',
        'validation' => [
            'code' => [
                'required' => 'Please Enter Code',
                'exists' => 'This Code Is invalid ',
                'expired' => 'This Code Is expired ',
                'custom' => 'This Code Is not available for you',
                'not_found' => 'This Code Is not found',
            ],
            'coupon_value_greater_than_cart_total' => 'The coupon value is greater than the total value of the cart',
            'condition_error' => 'Something went wrong, please try again later',
            'coupon_is_used' => 'You are already using this coupon',
            'cart_is_empty' => 'Cart is empty, Please add products to cart firstly',
            'user_max_uses' => 'Sorry, you have exceeded the maximum count to use this coupon',
        ],
    ],
];
