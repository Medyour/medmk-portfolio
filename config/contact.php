<?php

return [
    'recipient' => [
        'address' => env('CONTACT_TO_ADDRESS', 'contact@example.com'),
        'name' => env('CONTACT_TO_NAME', 'Mohamed M’Kirchel'),
    ],

    'categories' => [
        'automation' => 'Automatiser un processus',
        'integration' => 'Connecter des systèmes',
        'data' => 'Fiabiliser des données',
        'other' => 'Autre besoin',
    ],
];
