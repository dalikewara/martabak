<?php namespace model;

class Controller extends \framework\parents\Model
{
    protected static $table = 'll1l1l1ll_controllers';

    protected static $columns = [
        'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'name'       => 'VARCHAR(40) NOT NULL',
        'filename'   => 'VARCHAR(255) NOT NULL',
        'comment'    => 'VARCHAR(255) NOT NULL',
        'created_at' => 'TIMESTAMP',
        'updated_at' => 'TIMESTAMP',
    ];
}
