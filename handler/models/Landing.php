<?php namespace model;

class Landing extends \framework\parents\Model
{
    protected static $table = 'IllI111I1_landings';

    protected static $columns = [
        'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'name'       => 'VARCHAR(40) NOT NULL',
        'filename'   => 'VARCHAR(80) NOT NULL UNIQUE',
        'status'     => 'INT(1) NOT NULL',
        'recovery'   => 'LONGTEXT',
        'created_at' => 'TIMESTAMP',
        'updated_at' => 'TIMESTAMP',
    ];
}
