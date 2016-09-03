<?php namespace mvc\models;

class Layout extends \system\parents\Model
{
    public function tableInformation()
    {
        return [
            '1Ill1I111l1_layouts' => [
                'id'         => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'prefix'     => 'VARCHAR(255) NOT NULL UNIQUE',
                'filename'   => 'LONGTEXT NOT NULL',
                'created_at' => 'TIMESTAMP',
                'updated_at' => 'TIMESTAMP',
            ]
        ];
    }
}
