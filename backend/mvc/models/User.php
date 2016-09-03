<?php namespace mvc\models;

class User extends \system\parents\Model
{
    public function tableInformation()
    {
        return [
            'Illl11I1ll1_users' => [
                'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'fullname'   => 'VARCHAR(255) NOT NULL',
                'username'   => 'VARCHAR(255) NOT NULL UNIQUE',
                'email'      => 'VARCHAR(255) NOT NULL UNIQUE',
                'password'   => 'VARCHAR(255) NOT NULL',
                'created_at' => 'TIMESTAMP',
                'updated_at' => 'TIMESTAMP',
            ]
        ];
    }
}
