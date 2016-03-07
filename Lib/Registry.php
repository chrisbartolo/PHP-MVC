<?php
/**
 * this is the base rgistry which stores all vars and objects needed across all calls
 * @author Christopher Bartolo <chris@chrisbartolo.com>
 **/

class Registry {
    
    private $_vars = array();
    
    public function __construct() {
        
    }

    public function __set($index, $value) {
        $this->_vars[$index] = $value;
    }

    public function __get($index) {
        if(isset($this->_vars[$index])) {
            return $this->_vars[$index];
        } else {
            return false;
        }
    }
    
    public function returnVariables() {
        return $this->_vars;
    }
}