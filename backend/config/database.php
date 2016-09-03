<?php return [
'default_connection' => 'mysql',
'connections' => [
    'mysql' => [
        'DB_HOST'     => 'your_database_host',
        'DB_NAME'     => 'your_database_name',
        'DB_USERNAME' => 'your_database_username',
        'DB_PASSWORD' => 'your_database_password'
    ]
],

// Ignore these
'auto_connect' => TRUE,
'pdo_fetch_style' => PDO::FETCH_CLASS,
];
