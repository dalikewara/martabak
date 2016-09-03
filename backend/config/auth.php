<?php
return [
'use_cookie' => FALSE,
'protected_rule' => [
    'auth' => [
        'on_false' => 'protected_rule\RedirectTo::login',
    ],
],
];
