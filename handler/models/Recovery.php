<?php namespace model;

class Recovery extends \framework\parents\Model
{
    protected static $table = 'I11lI1IIl_recovery';
    
    protected static $columns = [
        'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'type'       => 'VARCHAR(10) NOT NULL',
        'type_id'    => 'INT(11)',
        'content'    => 'LONGTEXT',
        'created_at' => 'TIMESTAMP',
        'updated_at' => 'TIMESTAMP',
    ];
}
