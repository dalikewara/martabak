<?php namespace controller\config;

/**
* Martabak Model configuration.
* This class is used to call Model directly. It's dinamic Model caller.
* We just need to initialize a property based on the Model name.
*
* @example   $this->Note   to call Model 'Note'.
*/
class Model
{
    /**
    * Get Model object.
    *
    * @param    string   $param
    * @return   object
    */
    function __get($param)
    {
        $namespace = '\\model\\' . $param;
        $this->$param = new $namespace;

        return $this->$param;
    }
}
