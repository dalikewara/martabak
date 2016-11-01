<?php namespace model;

class Layout extends \framework\parents\Model
{
    protected static $table = 'Il1IIlIl1_layouts';

    protected static $columns = [
        'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'name'       => 'VARCHAR(40) NOT NULL',
        'filename'   => 'VARCHAR(255) NOT NULL',
        'created_at' => 'TIMESTAMP',
        'updated_at' => 'TIMESTAMP',
    ];
}
