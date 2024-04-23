<?php

return [
    'title' => [
        'maxlength' => 60,
    ],
    'phone_number' => [
        'regex' => '(0)[0-9]{10,15}',
        'maxlength' => 15,
    ],
];
