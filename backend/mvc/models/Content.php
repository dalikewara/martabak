<?php namespace mvc\models;

class Content extends \system\parents\Model
{
    public function tableInformation()
    {
        return [
            '1IlI1I1lIlI_contents' => [
                'id'           => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'user_id'      => 'INT(11) NOT NULL',
                'route_prefix' => 'VARCHAR(255) NOT NULL',
                'slug'         => 'VARCHAR(255) NOT NULL UNIQUE',
                'title'        => 'VARCHAR(255) NOT NULL',
                'filename'     => 'LONGTEXT',
                'status'       => 'INT(1) NOT NULL',
                'created_at'   => 'TIMESTAMP',
                'updated_at'   => 'TIMESTAMP',
            ]
        ];
    }
}
