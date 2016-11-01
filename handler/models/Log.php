<?php namespace model;

class Log extends \framework\parents\Model
{
    protected static $table = 'Il1l1l1Il_logs';

    protected static $columns = [
        'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'message'    => 'VARCHAR(255) NOT NULL',
        'created_at' => 'TIMESTAMP',
    ];
}
