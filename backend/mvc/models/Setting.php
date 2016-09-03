<?php namespace mvc\models;

class Setting extends \system\parents\Model
{
    public function tableInformation()
    {
        return [
            'lIlI1Ill1l1_settings' => [
                'id'    => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'meta'  => 'VARCHAR(255) NOT NULL UNIQUE',
                'value' => 'VARCHAR(255) NOT NULL',
            ]
        ];
    }
}
