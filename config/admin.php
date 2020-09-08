<?php
return [
    'extensions' => [
        'summernote' => [
            //Set to false if you want to disable this extension
            'enable' => true,
            // Editor configuration
            'config' => [
                'lang'   => 'ru-RU',
                'height' => 500,
            ]
        ]
    ],
    'email' => [
        'admin' => env('MAIL_ADMIN', 'olegasafov@p24.site'),
        'admin2' => env('MAIL_ADMIN2', 'veronika@p24.site')
    ]
];
