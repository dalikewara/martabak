<?php namespace mvc\models;

class Route extends \system\parents\Model
{
    public function tableInformation()
    {
        return [
            'IIll1I11Il1_routes' => [
                'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'prefix'     => 'VARCHAR(255) NOT NULL UNIQUE',
                'route'      => 'VARCHAR(255) NOT NULL UNIQUE',
                'path'       => 'VARCHAR(255) NOT NULL',
                'method'     => 'VARCHAR(255) NOT NULL',
                'system'     => 'INT(1) NOT NULL',
                'created_at' => 'TIMESTAMP',
                'updated_at' => 'TIMESTAMP',
            ]
        ];
    }
}
