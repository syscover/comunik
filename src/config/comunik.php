<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Themes Folder
    |--------------------------------------------------------------------------
    |
    | Routes to themes folder
    |
    */

    'themesFolder'              => '/packages/syscover/comunik/themes/',


    /*
    |--------------------------------------------------------------------------
    | Show mailing online URL
    |--------------------------------------------------------------------------
    |
    | Base URL to show mailing online
    |
    */

    'showOnlineLink'            => '/comunik/email/services/campaigns/show/#message#/#contact#',


    /*
    |--------------------------------------------------------------------------
    | Unsubscribe URL
    |--------------------------------------------------------------------------
    |
    | Unsubscribe URL
    |
    */

    'unsubscribeUrl'            => '/comunik/contacts/unsubscribe/email/#contact#',


    /*
    |--------------------------------------------------------------------------
    | Track pixel
    |--------------------------------------------------------------------------
    |
    | Pixel to track mailing
    |
    */

    'trackPixel'                => '/comunik/email/services/campaigns/analytics/#campaign#/#envio#',
];