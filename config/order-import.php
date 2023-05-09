<?php

return [
    'rules' => [
        'id' => ['integer', 'required', 'unique:orders'],
        'koper' => ['string', 'required'],
        'datum_tijd' => ['required', 'date_format:d/m/Y H:i'],
        'product' => ['string', 'required'],
        'vestiging_verkoper' => ['string', 'required'],
    ],

    'default_file' => base_path('orders.csv')
];
