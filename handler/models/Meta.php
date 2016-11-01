<?php namespace model;

class Meta extends \framework\parents\Model
{
    protected static $table = 'I1I1I1lll_metas';

    protected static $columns = [
        'id'        => 'INT AUTO_INCREMENT PRIMARY KEY',
        'custom_id' => 'INT',
        'type'      => 'VARCHAR(20) NOT NULL',
        'name'      => 'VARCHAR(20) NOT NULL',
        'value1'    => 'VARCHAR(255) NOT NULL',
        'value2'    => 'VARCHAR(255) NOT NULL',
        'value3'    => 'INT NOT NULL',
        'value4'    => 'TEXT NOT NULL',
        'value5'    => 'LONGTEXT NOT NULL',
        'value6'    => 'TIMESTAMP',
    ];
}
