<?php namespace controller\config;

class Allowed
{
    public
    
        $landings = ['homepage', 'construction'];
        
    function __get($param)
    {
        die('Illegal type!');
    }
        
    public function check($type, $index)
    {
        if(!in_array($index, $this->$type))
        {
            die('Your content is not allowed!');
        }
    }
}
