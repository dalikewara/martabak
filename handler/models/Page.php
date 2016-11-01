<?php namespace model;

class Page extends \framework\parents\Model
{
    protected static $table = 'I1IIIl1l1_pages';

    protected static $columns = [
        'id'           => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'title'        => 'VARCHAR(40) NOT NULL',
        'slug'         => 'VARCHAR(80) NOT NULL UNIQUE',
        'description'  => 'VARCHAR(255) NOT NULL',
        'filename'     => 'VARCHAR(80) NOT NULL UNIQUE',
        'status'       => 'INT(1) NOT NULL',
        'created_at'   => 'TIMESTAMP',
        'updated_at'   => 'TIMESTAMP',
    ];
}
