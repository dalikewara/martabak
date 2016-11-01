<?php namespace model;

class Note extends \framework\parents\Model
{
    protected static $table = 'l1IIIll11_notes';

    protected static $columns = [
        'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'title'      => 'VARCHAR(40) NOT NULL',
        'message'    => 'VARCHAR(255) NOT NULL',
        'created_at' => 'TIMESTAMP',
        'updated_at' => 'TIMESTAMP',
    ];
}
