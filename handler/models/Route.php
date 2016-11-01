<?php namespace model;

class Route extends \framework\parents\Model
{
    protected static $table = 'l1IlI1I1I_routes';

    protected static $columns = [
        'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'prefix'     => 'VARCHAR(20) NOT NULL UNIQUE',
        'uri'        => 'VARCHAR(80) NOT NULL UNIQUE',
        'target'     => 'VARCHAR(255) NOT NULL',
        'method'     => 'VARCHAR(10) NOT NULL',
        'system'     => 'INT(1) NOT NULL',
        'created_at' => 'TIMESTAMP',
        'updated_at' => 'TIMESTAMP',
    ];
}
