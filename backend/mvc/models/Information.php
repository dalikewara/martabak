<?php namespace mvc\models;

class Information extends \system\parents\Model
{
    public function tableInformation()
    {
        return [
            'l1l11IllIll_informations' => [
                'id'          => 'INT(1) AUTO_INCREMENT PRIMARY KEY',
                'version'     => 'VARCHAR(10) NOT NULL UNIQUE',
                'codename'    => 'VARCHAR(20) NOT NULL UNIQUE',
                'author'      => 'VARCHAR(255) NOT NULL UNIQUE',
                'license'     => 'VARCHAR(255) NOT NULL UNIQUE',
                'released_at' => 'VARCHAR(255) NOT NULL UNIQUE',
            ]
        ];
    }
}
