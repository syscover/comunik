<?php

return [

    //******************************************************************************************************************
    //***   Routes to themes folder
    //******************************************************************************************************************

    'themesFolder'              => '/packages/syscover/comunik/themes/',

    //******************************************************************************************************************
    //***   Operators for patterns
    //******************************************************************************************************************
    'patternsOperators'         => [
        (object)['id' => 'and',     'name' => 'pulsar::pulsar.and'],
        (object)['id' => 'or',      'name' => 'pulsar::pulsar.or']
    ],

    //******************************************************************************************************************
    //***   Actions target patterns
    //******************************************************************************************************************
    'patternActions'            => [
        (object)['id' => 1,      'name' => 'comunik::pulsar.nothing'],
        (object)['id' => 2,      'name' => 'comunik::pulsar.delete_contact_and_message'],
        (object)['id' => 3,      'name' => 'comunik::pulsar.unsubscribe_contact_and_delete_message'],
        (object)['id' => 4,      'name' => 'comunik::pulsar.delete_contact'],
        (object)['id' => 5,      'name' => 'comunik::pulsar.unsubscribe_contact'],
        (object)['id' => 6,      'name' => 'comunik::pulsar.delete_message'],
    ],
];