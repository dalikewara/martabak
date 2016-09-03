<?php namespace mvc\models;

class Home extends \system\parents\Model
{
    public function tableInformation()
    {
        return [
            'IIll1I11Ill_home' => [
                'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'filename'   => 'VARCHAR(255) UNIQUE',
                'status'     => 'INT(1) NOT NULL',
                'created_at' => 'TIMESTAMP',
                'updated_at' => 'TIMESTAMP',
            ]
        ];
    }
}
