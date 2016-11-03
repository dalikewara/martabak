<?php namespace model;

class User extends \framework\parents\Model
{
    protected static $table = '11lIl1I1l_users';

    protected static $columns = [
        'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
        'fullname'   => 'VARCHAR(80) NOT NULL',
        'username'   => 'VARCHAR(20) NOT NULL',
        'email'      => 'VARCHAR(80) NOT NULL',
        'password'   => 'VARCHAR(40) NOT NULL',
        'created_at' => 'TIMESTAMP',
        'updated_at' => 'TIMESTAMP',
    ];
}
