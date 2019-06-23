<?php

return [
    'Sms-Option' => [
        'Username' => 'tasawk',
        'Password' => 'tasawk@159',
        'Sender' => 'Tasawk',
        'Opration' => 'GET',
        'Url' => 'http://www.waselsms.com/api.php?comm=sendsms',
    ],
    'Components' => [
        'Address',
        'Banking',
        'City',
        'Common',
        'Contact',
        'Content',
        'Locale',
        'Option',
        'Order',
        'Product',
        'Subscription',
        'User',
        'Offers',
    ],
    'moyasar' => [
        'keys' => [
            'secret' => 'sk_test_J58q9jn6cx4NMTE88JijvfZvSQBoqiTevKbESieV',
            'public' => 'pk_test_woyps8ZK7NtrzjVqekP41LD2YtpHyWqWSMvpA7Po',
        ],
        'callback_url' => 'callback_url'
    ],
    'payments_ways' => [
        [
            'value' => 'cash',
            'image' => asset('assets/front/images/way5.png'),
        ],
        [
            'value' => 'credit',
            'image' => asset('assets/front/images/way4.png'),
        ],
        [
            'value' => 'mada',
            'image' => asset('assets/front/images/way3.png'),
        ],
//        [
//            'value' => 'sadad',
//            'image' => asset('assets/front/images/way2.png'),
//        ],
        [
            'value' => 'bank',
            'image' => asset('assets/front/images/way1.png'),
        ],
    ],
    'payment-types' => [
        'cash',
        'credit',
        'mada',
        'sadad',
        'bank',
    ],
    'payment-types-titles' => [
        'cash' => __('Cash'),
        'credit' => __('Credit'),
        'mada' => __('Mada'),
        'sadad' => __('Sadad'),
        'bank' => __('Bank'),
    ],
    'firebase_server_key' => 'AAAAnGgfywg:APA91bFm8egxIYYe84uslltGo4Zn3lqFntAYZwyXBnZ0fMkkEHZ_Sp9O54uFJykJTGGFv31hIphAe_9F3lwuN97_ZkB2PNU6wGPQHFsTWQfKi2E45F0G9L38mS0BrrJayEUvmY0ayLnP',
    'reports'=>[
        'counters'=>[
                
        ],
    ]
];
