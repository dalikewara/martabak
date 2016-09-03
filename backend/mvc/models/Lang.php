<?php namespace mvc\models;

class Lang extends \system\parents\Model
{
    public function tableInformation()
    {
        return [
            'lllI11ll1I1_langs' => [
                'id'     => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'prefix' => 'VARCHAR(255) NOT NULL UNIQUE',
                'value'  => 'VARCHAR(255) NOT NULL',
            ]
        ];
    }
}
