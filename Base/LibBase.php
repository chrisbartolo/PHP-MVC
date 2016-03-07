<?php
/**
 * this is the base lib
 * @author Christopher Bartolo <chris@chrisbartolo.com>
 **/

abstract class LibBase {
    /**
     * The registry object
     */
    private $_Registry = null;
    
    /**
     * always initialise the base lib with the registry object wich holds all values
     */
    public function __construct($Registry) {
        $this->_Registry = $Registry;
    }
   
}