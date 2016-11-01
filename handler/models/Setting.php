<?php namespace model;

class Setting extends \framework\parents\Model
{
    protected static $table = 'IllII1lII_settings';

    protected static $columns = [
        'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'name'       => 'VARCHAR(40) NOT NULL',
        'value'      => 'VARCHAR(255) NOT NULL',
        'created_at' => 'TIMESTAMP',
        'updated_at' => 'TIMESTAMP',
    ];
}
