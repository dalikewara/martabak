<?php

namespace App\Http\Controllers\Backend\Config;

class Error
{
    public $err, $errMethod, $errSave, $errDelete, $errTrash, $errRestore,
           $errRole, $errStatus, $errDate, $errTime, $errFill, $errProcess,
           $errType, $errName, $errSlug, $errTable, $errCheck, $errExists,
           $errFormat, $errSize, $errUpload;

    public function __construct()
    {
        $this->err         = 0;
        $this->errMethod   = '';
        $this->errSave     = '';
        $this->errDelete   = '';
        $this->errTrash    = '';
        $this->errRestore  = '';
        $this->errRole     = '';
        $this->errStatus   = '';
        $this->errDate     = '';
        $this->errTime     = '';
        $this->errFill     = '';
        $this->errProcess = '';
        $this->errType     = '';
        $this->errName     = '';
        $this->errSlug     = '';
        $this->errTable    = '';
        $this->errCheck    = '';
        $this->errExists   = '';
        $this->errFormat   = '';
        $this->errSize     = '';
        $this->errUpload   = '';
    }
}
