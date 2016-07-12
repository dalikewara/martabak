<?php

namespace App\Http\Controllers\Backend\Config;

class Dir
{
    public $picture;

    public function __construct()
    {
        $this->picture = $_SERVER['DOCUMENT_ROOT']. '/martabak-frontend/user/media/pictures';
    }

    public function url($content)
    {
        switch($content)
        {
            case 'pictures':
                return '/martabak-frontend/user/media/pictures';
                break;

            case 'admin-scripts':
                return '/martabak-frontend/admin/assets/scripts';
                break;
        }
    }
}
