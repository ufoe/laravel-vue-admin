<?php
namespace Friparia\Admin;

class Fluent
{
    protected $_name;
    protected $_type;
    protected $_description;

    public function __construct($type, $name){
        $this->_type = $type;
        $this->_name = $name;
    }

    public function __get($name){
        $name = "_".$name;
        if(in_array($name, ['_description'])){
            $array = $this->$name;
            return $array[0];
        }
        if(!is_null($this->$name)){
            return $this->$name;
        }
        return null;
    }

    public function __call($method, $parameters){
        $name = "_".$method;
        $this->$name = count($parameters) > 0 ? $parameters : true;
        return $this;
    }
}

