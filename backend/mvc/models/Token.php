<?php namespace mvc\models;

class Token extends \system\parents\Model
{
    public function tableInformation()
    {
        return [
            '1Ill11ll111_tokens' => [
                'id'       => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'user_id'  => 'INT(255) NOT NULL UNIQUE',
                'token'    => 'VARCHAR(255) NOT NULL',
            ]
        ];
    }
}
